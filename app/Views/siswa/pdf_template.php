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
        <h3>Mis Raudathul Athfal</h3>
        <?php foreach ($biayaData as $semester) : ?>
            <h3 class="title">Data Pembayaran Tahun Ajaran <?php echo $semester['semester']; ?></h3>
        <?php endforeach; ?>
        <hr>
        <h5><span class="label">Nama Siswa</span><span class="data">:<?php echo $siswaData['name']; ?></span></h5>
        <h5><span class="label">Nis</span><span class="data">:<?php echo $siswaData['nis']; ?></span></h5>
        <h5><span class="label">Kelas</span><span class="data">:<?php echo $siswaData['kelas']; ?></span></h5><br>
        <h5>Data Pembayaran Tagihan Uang SPP</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jatuh Tempo</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                    <th>No. Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Keterangan</th>
                    <th>Chanel</th>
                    <th>Tempat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tagihanData as $index => $tagihan) : ?>
                    <tr>
                        <td style="font-size: 10px; text-align: center;"><?php echo $index + 1; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['jatuhtempo']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['bulan']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['jumlah']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['no_bayar']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['tgl_bayar']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['keterangan']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['chanel']; ?></td>
                        <td style="font-size: 10px; text-align: center;"><?php echo $tagihan['tempat']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <h2>Keterangan</h2><br>
                    <h3>
                        Mohon pembayaran dilakukan selambat-lambatnya pada tanggal jatuh tempo setiap bulan.<br>
                        Apabila tercetak tidak sesuai dengan pembayaranmu, Segera hubungi petugas. Terima Kasih.
                    </h3>
                </td>
                <td width="200px">
                    <br/>
                    <h3>Bogor , <?= date('d/m/y') ?> <br />
                        Operator,</h3>
                        <br />
                        <br />
                        <br />
                        <h3>E-SPP Mis Raudathul Athfal<br>__________________________</h3>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>