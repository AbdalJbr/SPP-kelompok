<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\BiayaModel;
use App\Models\TagihanModel;
use App\Controllers\BaseController;
use Dompdf\Dompdf;
class AdminController extends BaseController
{
    protected $siswaModel;
    protected $userModel;
    protected $biayaModel;
    protected $tagihanModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->userModel = new UserModel();
        $this->biayaModel = new BiayaModel();
        $this->tagihanModel = new TagihanModel();

        if (session()->get('role') != "admin") {
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

        return view("admin/dashboard", $data);
    }

    public function astudenttables2()
    {
        $siswa = $this->siswaModel->findAll();
        $data = [
            'title' => 'Student Tables',
            'siswa' => $siswa
        ];
        return view("admin/student_tables", $data);
    }

    public function create2()
    {
        // $siswa_object = new SiswaModel();
        // $siswa = $siswa_object->insertBatch();
        $data = [
            'title' => 'Create Student',
            // 'siswa' => $siswa
        ];
        return view("admin/create_student", $data);
    }

    public function save2()
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

        $userData = [
            'id_siswa' => $id_siswa,
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('nis'),
            'password' => password_hash($this->request->getVar('tgl_lahir'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role')
        ];

        // Simpan data user
        $userModel = new UserModel();
        $userModel->insert($userData);

        return redirect()->to('studenttables2');
    }

    public function edit2($id_siswa)
    {
        // Mendapatkan data siswa berdasarkan ID
        $siswa = $this->siswaModel->find($id_siswa);

        // Menyusun data yang akan dikirim ke view
        $data = [
            'title' => 'Student Tables',
            'siswa' => $siswa
        ];

        // Memuat view edit_student.php dengan data siswa
        return view('admin/edit_student', $data);
    }

    public function update2($id_siswa)
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
                return redirect()->to('studenttables2');
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
    public function delete2($id_siswa)
    {
        $this->siswaModel->delete($id_siswa);
        return redirect()->to('studenttables2');
    }

    // transaksi
    public function transaction2()
    {
        $siswa = $this->siswaModel->findAll();
        $data = [
            'title' => 'Transaction Tables',
            'siswa' => $siswa
        ];
        return view("admin/transaction_tables", $data);
    }
    public function createtagihan2()
    {
        $data = [
            'title' => 'Create Tagihan',
        ];
        return view("admin/create_tagihan", $data);
    }

    public function savetagihan2()
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

        return redirect()->to('transaction2');
    }

    public function payment2($id_siswa)
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

        return view('admin/payment_tables', $data);
    }

    public function bayar2($id_spp)
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
        return redirect()->to('payment2/' . $id_siswa)->with('success', 'Pembayaran berhasil');
    }


    public function batal2($id_spp)
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
        return redirect()->to('payment2/' . $id_siswa)->with('success', 'Pembayaran berhasil');
    }

    public function transactionhistory2()
    {
        $data = [
            'title' => 'Transaction History'
        ];
        return view('admin/transaction_history', $data);
    }
    public function riwayattransaksi2()
    {
        $tgl_awal = $this->request->getGet('tgl_awal');
        $tgl_akhir = $this->request->getGet('tgl_akhir');

        // Query ke database
        $tagihanModel = new TagihanModel();
        $siswaModel = new SiswaModel();

        $riwayatTransaksi = $tagihanModel
            ->select('tagihan_spp.*, tbl_siswa.nis, tbl_siswa.name, tbl_siswa.kelas')
            ->join('tbl_siswa', 'tagihan_spp.id_siswa = tbl_siswa.id_siswa')
            ->where('tgl_bayar >=', $tgl_awal)
            ->where('tgl_bayar <=', $tgl_akhir)
            ->orderBy('no_bayar', 'ASC')
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
        $html = view('admin/laporan_pembayaran', $data);

        // Konversi HTML ke PDF
        $dompdf->loadHtml($html);

        // Mengatur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Outputkan PDF
        $dompdf->stream('Tagihan.pdf', ['Attachment' => false]);
    }

    public function profile2()
    {
        $data = [
            'title' => 'Profile'
        ];
        return view('admin/profile', $data);
    }
}
