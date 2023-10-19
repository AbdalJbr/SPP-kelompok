<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Keuangan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        /* Gaya CSS Anda */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header-info {
            margin-left: 20px;
        }

        .header-info h1,
        .header-info h2,
        .header-info h3,
        .header-info h5 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #333;
            font-size: 10px;
            text-align: center;
        }

        .title {
            position: relative;
            display: inline-block;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: fit-content;
            border-bottom: 1px solid black;
        }

        .label {
            display: inline-block;
            width: 90px;
            font-weight: bold;
        }

        .data {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="header-info">
        <h3>Laporan Pembayaran SPP</h3>
        <h5>Per Tanggal <?= $tgl1 . ' s/d ' . $tgl2; ?></h5>
        <hr>
        <br>
        <h5>Data Pembayaran Tagihan Uang SPP</h5>
        <table>
            <tr>
                <th>NO</th>
                <th>ID</th>
                <th>NIS</th>
                <th>NAMA SISWA</th>
                <th>KELAS</th>
                <th>NO. BAYAR</th>
                <th>PEMBAYARAN BULAN</th>
                <th>JUMLAH</th>
                <th>KETERANGAN</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($riwayatTransaksi as $dta) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dta['id_spp']; ?></td>
                    <td><?= $dta['nis']; ?></td>
                    <td><?= $dta['name']; ?></td>
                    <td><?= $dta['kelas']; ?></td>
                    <td><?= $dta['no_bayar']; ?></td>
                    <td><?= $dta['bulan']; ?></td>
                    <td><?= $dta['jumlah']; ?></td>
                    <td><?= $dta['keterangan']; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="7" align="right">TOTAL</td>
                <td><?= $total; ?></td>
                <td></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <h2>Keterangan</h2><br>
                    <h3>
                        Laporan ini berisi daftar rincian transaksi pembayaran yang dilakukan oleh siswa dan admin pada rentang tanggal tersebut.<br>
                        Pastikan informasi ini akurat dan sesuai dengan kegiatan pembayaran yang terjadi. Jika terdapat kesalahan atau pertanyaan, harap segera menghubungi petugas terkait. Terima Kasih.
                    </h3>
                </td>
                <td width="200px">
                    <br />
                    <h3>Bogor , <?= date('d/m/y') ?> <br />
                        Operator,</h3>
                    <br />
                    <br />
                    <br />
                    <h3><?= session()->get('name') ?><br>__________________________</h3>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>