<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\BiayaModel;
use App\Models\TagihanModel;
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SadminController extends BaseController
{
    protected $siswaModel;
    protected $userModel;
    protected $adminModel;
    protected $biayaModel;
    protected $tagihanModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->userModel = new UserModel();
        $this->adminModel = new AdminModel();
        $this->biayaModel = new BiayaModel();
        $this->tagihanModel = new TagihanModel();

        if (session()->get('role') != "superadmin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        $kelas = ["I A", "I B", "II A", "II B", "III A", "III B", "IV A", "IV B", "V A", "V B", "VI A", "VI B"];

        // Lakukan query untuk setiap kelas dan tambahkan jumlah siswa ke $kelasData
        $model = new SiswaModel();
        $kelasData = [];
        foreach ($kelas as $k) {
            $jumlahSiswa = $model->where('kelas', $k)->countAllResults();
            $kelasData[] = $jumlahSiswa;
        }

        // Membuat instance dari SiswaModel
        $siswaModel = new SiswaModel();

        // Mendapatkan jumlah siswa dari SiswaModel
        $totalStudents = $siswaModel->countAll();

        // Mengambil tagihan dengan keterangan 'Lunas'
        $tagihanLunas = $this->tagihanModel->where('keterangan', 'Lunas')->findAll();

        // Inisialisasi variabel totalJumlah
        $totalLunas = 0;

        // Menjumlahkan nilai kolom 'jumlah' dari tagihan yang lunas
        foreach ($tagihanLunas as $tagihan) {
            $totalLunas += $tagihan['jumlah'];
        }
        // Format angka dengan digit desimal
        $totalLunasFormatted = number_format($totalLunas);

        $tagihanBelumLunas = $this->tagihanModel->where('keterangan', 'belum lunas')->findAll();

        // Inisialisasi variabel totalJumlah
        $totalBelumLunas = 0;

        // Menjumlahkan nilai kolom 'jumlah' dari tagihan yang belum lunas
        foreach ($tagihanBelumLunas as $tagihan) {
            $totalBelumLunas += $tagihan['jumlah'];
        }
        // Format angka dengan 3 digit desimal
        $totalBelumLunasFormatted = number_format($totalBelumLunas);

        // Mengambil tanggal hari ini
        $tanggalHariIni = date('Y-m-d');

        // Mengambil tagihan dengan keterangan 'Lunas' pada tanggal hari ini
        $tagihanLunasHarian = $this->tagihanModel->where('keterangan', 'Lunas')->where('tgl_bayar', $tanggalHariIni)->findAll();

        // Inisialisasi variabel totalLunas
        $totalLunasHarian = 0;

        // Menjumlahkan nilai kolom 'jumlah' dari tagihan yang lunas
        foreach ($tagihanLunasHarian as $tagihan) {
            $totalLunasHarian += $tagihan['jumlah'];
        }

        // Format angka dengan dua digit desimal
        $totalLunasHarianFormatted = number_format($totalLunasHarian);


        $data = [
            'title' => 'Dashboard',
            'kelasData' => $kelasData,
            'totalStudents' => $totalStudents,
            'totalLunasFormatted' => $totalLunasFormatted,
            'totalBelumLunasFormatted' => $totalBelumLunasFormatted,
            'totalLunasHarianFormatted' => $totalLunasHarianFormatted,
        ];

        return view("superadmin/dashboard", $data);
    }

    //Siswa
    public function studenttables()
    {
        $siswa = $this->siswaModel->findAll();
        $data = [
            'title' => 'Student Tables',
            'siswa' => $siswa
        ];
        return view("superadmin/student_tables", $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Student',
        ];
        return view("superadmin/create_student", $data);
    }

    public function save()
    {
        $siswaData = [
            'name' => $this->request->getVar('name'),
            'nis' => $this->request->getVar('nis'),
            'kelas' => $this->request->getVar('kelas'),
            'tahunajaran' => $this->request->getVar('tahunajaran'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'biaya' => $this->request->getVar('biaya'),
            'role' => $this->request->getVar('role')
        ];

        // Simpan data siswa
        $siswaModel = new SiswaModel();
        $siswaModel->insert($siswaData);

        // Ambil id_siswa terakhir
        $lastSiswa = $siswaModel->orderBy('id_siswa', 'DESC')->first();
        $id_siswa = $lastSiswa['id_siswa'];

        // Simpan data user
        $userData = [
            'id_siswa' => $id_siswa,
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('nis'),
            'password' => password_hash($this->request->getVar('tgl_lahir'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role')
        ];

        $userModel = new UserModel();
        $userModel->insert($userData);

        // Ambil tagihan berdasarkan semester terakhir
        $tagihanModel = new TagihanModel();
        $lastSemester = $tagihanModel->orderBy('id_semester', 'DESC')->first();

        // Cek apakah tagihan tersedia
        if ($lastSemester) {
            $tagihanList = $tagihanModel->where('id_semester', $lastSemester['id_semester'])->findAll(12); // Ambil 12 data tagihan saja

            // Simpan data tagihan untuk siswa baru
            foreach ($tagihanList as $tagihan) {
                $tagihanData = [
                    'id_siswa' => $id_siswa,
                    'id_semester' => $tagihan['id_semester'],
                    'jatuhtempo' => $tagihan['jatuhtempo'],
                    'bulan' => $tagihan['bulan'],
                    'jumlah' => $tagihan['jumlah'],
                    'keterangan' => 'belum lunas'
                ];

                $tagihanModel->insert($tagihanData);
            }
        }

        return redirect()->to('studenttables');
    }

    public function upload()
    {
        // Memeriksa apakah file Excel telah diunggah
        if ($this->request->getFile('excel_file')->isValid()) {
            $file = $this->request->getFile('excel_file');

            // Membaca file Excel menggunakan library seperti PhpSpreadsheet
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file->getTempName());
            $worksheet = $spreadsheet->getActiveSheet();

            // Ambil data dari setiap baris kecuali baris header
            $rowData = $worksheet->toArray();
            $dataCount = count($rowData);

            $siswaModel = new SiswaModel();
            $userModel = new UserModel();
            $tagihanModel = new TagihanModel();

            for ($i = 1; $i < $dataCount; $i++) {
                // Simpan data siswa
                $siswaData = [
                    'name' => $rowData[$i][0],
                    'nis' => $rowData[$i][1],
                    'kelas' => $rowData[$i][2],
                    'tahunajaran' => $rowData[$i][3],
                    'tgl_lahir' => $rowData[$i][4],
                    'biaya' => $rowData[$i][5],
                    'role' => $rowData[$i][6]
                ];
                $siswaModel->insert($siswaData);

                // Ambil id_siswa terakhir
                $lastSiswa = $siswaModel->orderBy('id_siswa', 'DESC')->first();
                $id_siswa = $lastSiswa['id_siswa'];

                // Simpan data user
                $userData = [
                    'id_siswa' => $id_siswa,
                    'name' => $rowData[$i][0],
                    'username' => $rowData[$i][1],
                    'password' => password_hash($rowData[$i][4], PASSWORD_DEFAULT),
                    'role' => $rowData[$i][6]
                ];
                $userModel->insert($userData);

                // Ambil tagihan berdasarkan semester terakhir
                $lastSemester = $tagihanModel->orderBy('id_semester', 'DESC')->first();

                // Cek apakah tagihan tersedia
                if ($lastSemester) {
                    $tagihanList = $tagihanModel->where('id_semester', $lastSemester['id_semester'])->findAll(12); // Ambil 12 data tagihan saja

                    // Simpan data tagihan untuk siswa baru
                    foreach ($tagihanList as $tagihan) {
                        $tagihanData = [
                            'id_siswa' => $id_siswa,
                            'id_semester' => $tagihan['id_semester'],
                            'jatuhtempo' => $tagihan['jatuhtempo'],
                            'bulan' => $tagihan['bulan'],
                            'jumlah' => $tagihan['jumlah'],
                            'keterangan' => 'belum lunas'
                        ];
                        $tagihanModel->insert($tagihanData);
                    }
                }
            }

            return redirect()->to('studenttables');
        } else {
            // File Excel tidak valid, tambahkan penanganan kesalahan di sini
        }
    }


    public function edit($id_siswa)
    {
        // Mendapatkan data siswa berdasarkan ID
        $siswa = $this->siswaModel->find($id_siswa);

        // Menyusun data yang akan dikirim ke view
        $data = [
            'title' => 'Student Tables',
            'siswa' => $siswa
        ];

        // Memuat view edit_student.php dengan data siswa
        return view('superadmin/edit_student', $data);
    }

    public function update($id_siswa)
    {
        // Mengambil data yang diinputkan melalui form edit
        $data = [
            'name' => $this->request->getVar('name'),
            'nis' => $this->request->getVar('nis'),
            'kelas' => $this->request->getVar('kelas'),
            'tahunajaran' => $this->request->getVar('tahunajaran'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'biaya' => $this->request->getVar('biaya'),
            'role' => $this->request->getVar('role')
        ];
        // Memperbarui data siswa berdasarkan ID
        $siswa = $this->siswaModel->find($id_siswa);
        if ($siswa) {
            $this->siswaModel->update($id_siswa, $data);

            // Memperbarui data pengguna (tbl_users) berdasarkan ID siswa
            $user = $this->userModel->where('id_siswa', $id_siswa)->first();
            if ($user) {
                // Mengambil data pengguna yang akan diperbarui
                $userData = [
                    'name' => $this->request->getVar('name'), // Menggunakan name sebagai name
                    'username' => $this->request->getVar('nis'), // Menggunakan nis sebagai username
                    'password' => password_hash($this->request->getVar('tgl_lahir'), PASSWORD_DEFAULT), // Menggunakan tgl_lahir sebagai password
                    'role' => $this->request->getVar('role') // Menggunakan role sebagai role
                ];

                $this->userModel->update($user['id_users'], $userData);

                // Redirect ke halaman siswa setelah berhasil memperbarui data
                return redirect()->to('studenttables');
            } else {
                // Handle jika data pengguna tidak ditemukan
                // ...
            }
        } else {
            // Handle jika data siswa tidak ditemukan
            // ...
        }
    }

    // Hapus Data Siswa
    public function delete($id_siswa)
    {
        $this->siswaModel->delete($id_siswa);
        return redirect()->to('studenttables');
    }

    //Admin
    public function admintables()
    {
        $admin = $this->adminModel->findAll();
        $data = [
            'title' => 'Admin Tables',
            'admin' => $admin
        ];
        return view("superadmin/admin_tables", $data);
    }

    public function createadmin()
    {
        $data = [
            'title' => 'Create Admin',
            // 'siswa' => $siswa
        ];
        return view("superadmin/create_admin", $data);
    }
    public function saveadmin()
    {
        $adminData = [
            'name' => $this->request->getVar('name'),
            'no_id' => $this->request->getVar('no_id'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'role' => $this->request->getVar('role')
        ];

        // Simpan data siswa
        $adminModel = new AdminModel();
        $adminModel->insert($adminData);

        // Ambil id_siswa terakhir
        $lastAdmin = $adminModel->orderBy('id_admin', 'DESC')->first();
        $id_admin = $lastAdmin['id_admin'];

        $userData = [
            'id_admin' => $id_admin,
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('no_id'),
            'password' => password_hash($this->request->getVar('tgl_lahir'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role')
        ];

        // Simpan data user
        $userModel = new UserModel();
        $userModel->insert($userData);

        return redirect()->to('admintables');
    }

    public function deleteadmin($id_admin)
    {
        $this->adminModel->delete($id_admin);
        return redirect()->to('admintables');
    }

    public function editadmin($id_admin)
    {
        // Mendapatkan data siswa berdasarkan ID
        $admin = $this->adminModel->find($id_admin);

        // Menyusun data yang akan dikirim ke view
        $data = [
            'title' => 'Student Tables',
            'admin' => $admin
        ];

        // Memuat view edit_student.php dengan data siswa
        return view('superadmin/edit_admin', $data);
    }

    public function updateadmin($id_admin)
    {
        // Mengambil data yang diinputkan melalui form edit
        $data = [
            'name' => $this->request->getVar('name'),
            'no_id' => $this->request->getVar('no_id'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'role' => $this->request->getVar('role')
        ];
        // Memperbarui data siswa berdasarkan ID
        $admin = $this->adminModel->find($id_admin);
        if ($admin) {
            $this->adminModel->update($id_admin, $data);

            // Memperbarui data pengguna (tbl_users) berdasarkan ID siswa
            $user = $this->userModel->where('id_admin', $id_admin)->first();
            if ($user) {
                // Mengambil data pengguna yang akan diperbarui
                $userData = [
                    'name' => $this->request->getVar('name'), // Menggunakan name sebagai name
                    'username' => $this->request->getVar('no_id'), // Menggunakan nis sebagai username
                    'password' => password_hash($this->request->getVar('tgl_lahir'), PASSWORD_DEFAULT), // Menggunakan tgl_lahir sebagai password
                    'role' => $this->request->getVar('role') // Menggunakan role sebagai role
                ];

                $this->userModel->update($user['id_users'], $userData);

                // Redirect ke halaman siswa setelah berhasil memperbarui data
                return redirect()->to('admintables');
            } else {
                // Handle jika data pengguna tidak ditemukan
                // ...
            }
        } else {
            // Handle jika data siswa tidak ditemukan
            // ...
        }
    }

    // transaksi
    public function transaction()
    {
        $siswa = $this->siswaModel->findAll();

        $data = [
            'title' => 'Transaction Tables',
            'siswa' => $siswa
        ];
        return view("superadmin/transaction_tables", $data);
    }
    public function createtagihan()
    {
        $data = [
            'title' => 'Create Tagihan',
        ];
        return view("superadmin/create_tagihan", $data);
    }

    public function savetagihan()
    {
        $biayaData = [
            'semester' => $this->request->getVar('semester'),
            'biaya' => $this->request->getVar('biaya')
        ];

        $bulan = [
            '01' => 'januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        // Simpan data biaya
        $biayaModel = new BiayaModel();
        $biayaModel->insert($biayaData);

        // Ambil id_semester terakhir
        $lastBiaya = $biayaModel->orderBy('id_semester', 'DESC')->first();
        $id_semester = $lastBiaya['id_semester'];

        // Ambil semua siswa
        $siswaModel = new SiswaModel();
        $siswaList = $siswaModel->findAll();

        // Simpan data tagihan untuk setiap siswa
        $tagihanModel = new TagihanModel();

        foreach ($siswaList as $siswa) {
            $id_siswa = $siswa['id_siswa'];

            for ($i = 0; $i < 12; $i++) {
                // Tanggal jatuh tempo setiap tanggal 10
                $awaltempo = $this->request->getVar('jatuhtempo');
                $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime($awaltempo)));
                $bulanTagihan = $bulan[date('m', strtotime($jatuhtempo))] . " " . date('Y', strtotime($jatuhtempo));

                $tagihanData = [
                    'id_siswa' => $id_siswa,
                    'id_semester' => $id_semester,
                    'jatuhtempo' => $jatuhtempo,
                    'bulan' => $bulanTagihan,
                    'jumlah' => $this->request->getVar('biaya'),
                    'keterangan' => 'belum lunas'
                ];

                $tagihanModel->insert($tagihanData);
            }
        }

        return redirect()->to('transaction');
    }

    public function payment($id_siswa)
    {
        $tagihanModel = new TagihanModel();
        $siswaModel = new SiswaModel();
        $semester = $this->biayaModel->findAll();
        // Get the payments for the specified id_siswa
        $payment = $tagihanModel->where('id_siswa', $id_siswa)->findAll();

        // Get the details of the specified id_siswa
        $siswa = $siswaModel->find($id_siswa);

        $data = [
            'title' => 'Transaction Tables',
            'payment' => $payment,
            'semester' => $semester,
            'siswa' => [$siswa]
        ];

        return view('superadmin/payment_tables', $data);
    }

    public function bayar($id_spp)
    {
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->find($id_spp);

        // Tentukan nilai kolom-kolom yang ingin diisi
        $noBayar = date("YmdHis");
        $tglBayar = date("Y/m/d");
        $keterangan = 'Lunas';
        $chanel = session()->get('name');
        $tempat = 'Tata Usaha';
        $idUsers = session()->get('id_users');

        // Buat array data untuk disimpan ke dalam tabel pembayaran
        $data = [
            'no_bayar' => $noBayar,
            'tgl_bayar' => $tglBayar,
            'keterangan' => $keterangan,
            'chanel' => $chanel,
            'tempat' => $tempat,
            'id_users' => $idUsers
        ];

        // Simpan data pembayaran ke dalam tabel menggunakan model
        $tagihanModel = new TagihanModel();
        $tagihanModel->update($id_spp, $data); // Menggunakan metode update dengan ID spp sebagai parameter

        $id_siswa = $tagihan['id_siswa'];
        return redirect()->to('payment/' . $id_siswa)->with('success', 'Pembayaran berhasil');
    }


    public function batal($id_spp)
    {
        // Ambil data pembayaran berdasarkan ID spp
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->find($id_spp);

        $data = [
            'id_spp' => $tagihan['id_spp'],
            'no_bayar' => null,
            'tgl_bayar' => null,
            'keterangan' => 'belum lunas',
            'chanel' => null,
            'tempat' => null,
            'id_users' => null
        ];


        // Simpan data pembayaran ke dalam tabel menggunakan model
        $tagihanModel = new TagihanModel();
        $tagihanModel->update($id_spp, $data); // Menggunakan metode update dengan ID spp sebagai parameter
        $id_siswa = $tagihan['id_siswa'];
        return redirect()->to('payment/' . $id_siswa)->with('success', 'Pembayaran berhasil');
    }

    public function transactionhistory()
    {
        $data = [
            'title' => 'Transaction History'
        ];
        return view('superadmin/transaction_history', $data);
    }

    public function riwayattransaksi()
    {
        $tgl_awal = $this->request->getGet('tgl_awal');
        $tgl_akhir = $this->request->getGet('tgl_akhir');
        $status = $this->request->getGet('status');


        // Query ke database
        $tagihanModel = new TagihanModel();
        $siswaModel = new SiswaModel();

        $riwayatTransaksi = $tagihanModel
            ->select('tagihan_spp.*, tbl_siswa.nis, tbl_siswa.name, tbl_siswa.kelas')
            ->join('tbl_siswa', 'tagihan_spp.id_siswa = tbl_siswa.id_siswa')
            ->where('tgl_bayar >=', $tgl_awal)
            ->where('tgl_bayar <=', $tgl_akhir)
            ->orderBy('keterangan', 'ASC')
            ->findAll();

        $total = 0;

        foreach ($riwayatTransaksi as $dta) {
            $total += $dta['jumlah'];
        }

        $data = [
            'riwayatTransaksi' => $riwayatTransaksi,
            'total' => $total,
            'tgl1' => $tgl_awal,
            'tgl2' => $tgl_akhir,
        ];

        // Load library dompdf
        $dompdf = new Dompdf();

        // Buat HTML untuk ditampilkan di PDF
        $html = view('superadmin/laporan_pembayaran', $data);

        // Konversi HTML ke PDF
        $dompdf->loadHtml($html);

        // Mengatur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Outputkan PDF
        $dompdf->stream('Tagihan.pdf', ['Attachment' => false]);
    }
    public function riwayattransaksi2()
    {
        $keterangan = $this->request->getGet('keterangan');


        // Query ke database
        $tagihanModel = new TagihanModel();
        $siswaModel = new SiswaModel();

        $riwayatTransaksi = $tagihanModel
            ->select('tagihan_spp.*, tbl_siswa.nis, tbl_siswa.name, tbl_siswa.kelas')
            ->join('tbl_siswa', 'tagihan_spp.id_siswa = tbl_siswa.id_siswa')
            ->where('keterangan ==', $keterangan)
            ->orderBy('keterangan', 'ASC')
            ->findAll();

        $total = 0;

        foreach ($riwayatTransaksi as $dta) {
            $total += $dta['jumlah'];
        }

        $data = [
            'riwayatTransaksi' => $riwayatTransaksi,
            'total' => $total,
        ];

        // Load library dompdf
        $dompdf = new Dompdf();

        // Buat HTML untuk ditampilkan di PDF
        $html = view('superadmin/laporan_pembayaran', $data);

        // Konversi HTML ke PDF
        $dompdf->loadHtml($html);

        // Mengatur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Outputkan PDF
        $dompdf->stream('Tagihan.pdf', ['Attachment' => false]);
    }



    public function profile()
    {
        $data = [
            'title' => 'Profile'
        ];
        return view('superadmin/profile', $data);
    }
}
