<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= site_url('siswa') ?>">
            <img src="<?= base_url(); ?>/assets/img/Logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">ADM Mis.Raudlatul Atfal</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('siswa') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Student pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white active bg-gradient-dark shadow-dark" href="<?= site_url('paymentsiswa/' . session()->get('id_siswa')) ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('logout') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 border-radius-xl z-index-sticky blur shadow-blur left-auto" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transaction Tables</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payment Tables</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Payment Tables</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
                <li class="nav-item d-flex align-items-center d-sm-inline d-none">
                    <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"> <?= session()->get('name') ?> - Student</span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Payment Tables</h6>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <div class="col-4 align-middle text-center">
                                    <select class="form-select" id="semester-select" aria-label="Default select example">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        <?php foreach ($semester as $row) : ?>
                                            <option value="<?= $row['id_semester']; ?>"><?= $row['semester']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <a href="#" id="cetak-tagihan-btn" class="btn bg-gradient-dark shadow-dark">Cetak Tagihan</a>
                                </div>
                                <table class="table align-items-center mb-0" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chanel Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Bayar</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($payment as $k) : ?>
                                            <tr data-semester="<?= $k['id_semester']; ?>">
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $i++; ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $k['bulan']; ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">Rp.<?= number_format($k['jumlah']); ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php if ($k['keterangan'] === 'Lunas') : ?>
                                                        <span class="text-white font-weight-bold badge bg-gradient-success"><?= $k['keterangan']; ?></span>
                                                    <?php else : ?>
                                                        <span class="text-white font-weight-bold badge bg-gradient-danger"><?= $k['keterangan']; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $k['no_bayar']; ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $k['tgl_bayar']; ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $k['chanel']; ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $k['tempat']; ?></span>
                                                </td>
                                                <td class="align-middle text-center text-info">
                                                    <?php if ($k['keterangan'] == 'Lunas') : ?>
                                                        <span class="text-success text-xs font-weight-bold">Success</span>
                                                    <?php else : ?>
                                                        <a href="<?= site_url('bayarspp/' . $k['id_spp']) ?>" class="badge badge-sm bg-gradient-success">Bayar</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php if ($i > 12) {
                                                $i = 1;
                                            } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                <span>Copyright &copy; <?= date('Y'); ?> Lembaga Administrasi Pelajar Mis.Raudlatul Atfal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</main>
<!--   Core JS Files   -->
<script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/plugins/chartjs.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tableRows = document.querySelectorAll("#example tbody tr");
        for (var i = 12; i < tableRows.length; i++) {
            tableRows[i].style.display = "none";
        }
    });
    $(document).ready(function() {
        $('#semester-select').change(function() {
            var selectedValue = $(this).val();

            if (selectedValue === '') {
                $('#example tbody tr').show();
            } else {
                $('#example tbody tr').hide();
                $('#example tbody tr[data-semester="' + selectedValue + '"]').show();
            }
        });
    });
</script>
<script>
    // Mendapatkan elemen select dan tombol cetak
    var selectSemester = document.getElementById('semester-select');
    var cetakTagihanBtn = document.getElementById('cetak-tagihan-btn');

    // Menambahkan event listener untuk saat tombol cetak diklik
    cetakTagihanBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Mendapatkan nilai terpilih dari select
        var selectedSemester = selectSemester.value;

        // Melakukan validasi jika ada pilihan yang terpilih
        if (selectedSemester) {
            // Membuat URL dengan nilai terpilih
            var url = '<?= site_url('generate-pdf/'); ?>' + selectedSemester;

            // Membuka URL dalam jendela baru
            window.open(url);
        }
    });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url(); ?>/assets/js/material-dashboard.min.js?v=3.1.0"></script>
<?= $this->endSection() ?>