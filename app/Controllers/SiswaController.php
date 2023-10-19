<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\TagihanModel;
use App\Models\BiayaModel;
use Midtrans\Config;
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Exception;
use Midtrans\Notification;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    use ResponseTrait;
    protected $biayaModel;
    public function __construct()
    {
        $this->biayaModel = new BiayaModel();
        if (session()->get('role') != "siswa") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $id_siswa = session('id_siswa');
        $tagihanModel = new TagihanModel();

        // Ambil tagihan dengan keterangan 'Lunas' berdasarkan id_siswa
        $tagihanLunas = $tagihanModel->where('id_siswa', $id_siswa)->where('keterangan', 'Lunas')->findAll();

        $totallunas = 0;

        foreach ($tagihanLunas as $tagihan) {
            $totallunas += $tagihan['jumlah'];
        }

        $formattedTotalLunas = number_format($totallunas);

        // Ambil tagihan dengan keterangan 'Belum Lunas' berdasarkan id_siswa
        $tagihanBelumLunas = $tagihanModel->where('id_siswa', $id_siswa)->where('keterangan', 'belum lunas')->findAll();

        $totalbelumlunas = 0;

        foreach ($tagihanBelumLunas as $tagihan) {
            $totalbelumlunas += $tagihan['jumlah'];
        }

        $formattedTotalBelumLunas = number_format($totalbelumlunas);

        $id_siswa = session('id_siswa');
        $siswaModel = new SiswaModel();

        // Ambil detail siswa untuk id_siswa tertentu
        $siswa = $siswaModel->find($id_siswa);

        $data = [
            'title' => 'Dashboard',
            'formattedTotalLunas' => $formattedTotalLunas,
            'formattedTotalBelumLunas' => $formattedTotalBelumLunas,
            'siswa' => [$siswa]
        ];
        return view("siswa/dashboard", $data);
    }

    public function paymentsiswa($id_siswa)
    {
        $tagihanModel = new TagihanModel();
        $semester = $this->biayaModel->findAll();
        // Get the payments for the specified id_siswa
        $payment = $tagihanModel->where('id_siswa', $id_siswa)->findAll();

        $data = [
            'title' => 'Transaction Tables',
            'payment' => $payment,
            'semester' => $semester
        ];
        return view('siswa/payment_tables', $data);
    }

    public function bayarspp($id_spp)
    {
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->find($id_spp);

        try {
            // Set your Merchant Server Key
            Config::$serverKey = 'SB-Mid-server-XQHp-FJo5F1fzLrPSrXn-ESE';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            Config::$isProduction = false;
            // Set sanitization on (default)
            Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            Config::$is3ds = true;
            $params = array(
                'transaction_details' => array(
                    'order_id' => $tagihan['id_spp'],
                    'gross_amount' => $tagihan['jumlah'],
                ),
                'customer_details' => array(
                    'first_name' => session()->get('name')
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $data = [
                'title' => 'Transaction Tables',
                'token' => $snapToken,
                'tagihan' => [$tagihan]
            ];

            return view('siswa/confirm_pay', $data);
        } catch (Exception $e) {
            // Exception handling for API error
            if ($e->getCode() == 400) {
                return redirect()->to('/paymentsiswa/' . $tagihan['id_siswa']);
            } else {
                // Handle other exceptions or show error message
                return view('error_page', ['error_message' => 'An error occurred. Please try again later.']);
            }
        }
    }


    public function callback()
    {
        // Ambil data callback dari Midtrans
        $rawPayload = file_get_contents('php://input');
        $payload = json_decode($rawPayload);

        // Proses data callback
        // Misalnya, periksa status pembayaran dan perbarui informasi pembayaran di database Anda
        // Update status pembayaran di database Anda

        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->find($payload->order_id);

        if ($payload->transaction_status == 'capture') {
            // Pembayaran berhasil
            // Lakukan proses sesuai dengan kebutuhan Anda
        } elseif ($payload->transaction_status == 'settlement') {
            // Pembayaran sudah terselesaikan
            // Update status pembayaran di database Anda
            // Buat array data untuk disimpan ke dalam tabel pembayaran
            $data = [
                'no_bayar' => $payload->va_number,
                'tgl_bayar' => $payload->transaction_time,
                'keterangan' => 'Lunas',
                'chanel' => $payload->payment_type,
                'tempat' => $payload->bank,
                'id_users' => session()->get('id_users')
            ];

            // Simpan data pembayaran ke dalam tabel menggunakan model
            $tagihanModel->update($payload->order_id, $data);
        } elseif ($payload->transaction_status == 'pending') {
            // Pembayaran dibatalkan
            // Buat array data untuk disimpan ke dalam tabel pembayaran
            $data = [
                'no_bayar' => $payload->va_number,
                'keterangan' => 'Pending',
                'chanel' => $payload->payment_type,
                'tempat' => $payload->bank,
                'id_users' => session()->get('id_users')
            ];

            // Simpan data pembayaran ke dalam tabel menggunakan model
            $tagihanModel->update($payload->order_id, $data);
        } elseif ($payload->transaction_status == 'expire') {
            // Pembayaran kadaluwarsa
            // Lakukan proses sesuai dengan kebutuhan Anda
        } elseif ($payload->transaction_status == 'cencel') {
            // Pembayaran masih dalam proses
        }

        // Kirim respons OK ke Midtrans
        $response = service('response');
        return $response->setStatusCode(200);
    }

    // public function callback()
    // {
    //     // Ambil data callback dari Midtrans
    //     $rawPayload = file_get_contents('php://input');
    //     $payload = json_decode($rawPayload);

    //     // Dapatkan status terbaru
    //     $orderId = $payload->order_id;
    //     $status = \Midtrans\Transaction::status($orderId);

    //     // Proses data callback dan status terbaru
    //     // ...

    //     // Lanjutkan dengan pemrosesan seperti sebelumnya
    //     $tagihanModel = new TagihanModel();
    //     $tagihan = $tagihanModel->find($payload->order_id);

    //     if ($status == 'capture') {
    //         // Pembayaran berhasil
    //         // Lakukan proses sesuai dengan kebutuhan Anda
    //     } elseif ($status == 'settlement') {
    //         // Pembayaran sudah terselesaikan
    //         // Update status pembayaran di database Anda
    //         // Buat array data untuk disimpan ke dalam tabel pembayaran
    //         $data = [
    //             'no_bayar' => $payload->va_number,
    //             'tgl_bayar' => $payload->transaction_time,
    //             'keterangan' => 'Lunas',
    //             'chanel' => $payload->payment_type,
    //             'tempat' => $payload->bank,
    //             'id_users' => session()->get('id_users')
    //         ];

    //         // Simpan data pembayaran ke dalam tabel menggunakan model
    //         $tagihanModel->update($payload->order_id, $data);
    //     } elseif ($status == 'pending') {
    //         // Pembayaran dibatalkan
    //         // Buat array data untuk disimpan ke dalam tabel pembayaran
    //         $data = [
    //             'no_bayar' => $payload->va_number,
    //             'keterangan' => 'Pending',
    //             'chanel' => $payload->payment_type,
    //             'tempat' => $payload->bank,
    //             'id_users' => session()->get('id_users')
    //         ];

    //         // Simpan data pembayaran ke dalam tabel menggunakan model
    //         $tagihanModel->update($payload->order_id, $data);
    //     } elseif ($status == 'expire') {
    //         // Pembayaran kadaluwarsa
    //         // Lakukan proses sesuai dengan kebutuhan Anda
    //     } elseif ($status == 'cancel') {
    //         // Pembayaran masih dalam proses
    //     }

    //     // Kirim respons OK ke Midtrans
    //     $response = service('response');
    //     return $response->setStatusCode(200);
    // }

    public function generatePDF($id_semester)
    {
        // Mengambil id_siswa dari session atau sesuaikan dengan cara Anda untuk mendapatkan id_siswa yang sesuai
        $id_siswa = session()->get('id_siswa');

        // Mengambil informasi siswa berdasarkan id_siswa
        $siswaModel = new SiswaModel();
        $siswaData = $siswaModel->find($id_siswa);

        // Mengambil informasi tagihan berdasarkan id_semester dan id_siswa
        $tagihanModel = new TagihanModel();
        $tagihanData = $tagihanModel->where('id_semester', $id_semester)
            ->where('id_siswa', $id_siswa)
            ->findAll();

        // Mengambil informasi biaya berdasarkan id_semester
        $biayaModel = new BiayaModel();
        $biayaData = $biayaModel->where('id_semester', $id_semester)->findAll();

        // Generate the PDF
        $dompdf = new Dompdf();
        $html = view('siswa/pdf_template', ['siswaData' => $siswaData, 'tagihanData' => $tagihanData, 'biayaData' => $biayaData]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output the generated PDF
        $dompdf->stream('Tagihan.pdf', ['Attachment' => false]);
    }
}
