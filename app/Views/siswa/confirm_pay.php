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
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Transaction</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payment Details</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Payment Details</h6>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 mt-0 mb-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Payment Details</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="table-responsive p-5">
                            <?php foreach ($tagihan as $s) : ?>
                                <div class="col">
                                    <div class="card mb-5">
                                        <div class="card-body text-center">
                                            <img src="https://cdn-icons-png.flaticon.com/128/9919/9919236.png" alt="avatar" style="width: 100px;"><br>
                                            <span class="text-secondary text-xs font-weight-bold">Nama : <?= session()->get('name') ?></span><br>
                                            <span class="text-secondary text-xs font-weight-bold">Jumlah : Rp.<?= number_format($s['jumlah']); ?></span><br>
                                            <span class="text-secondary text-xs font-weight-bold">Bulan : <?= $s['bulan']; ?></span><br>
                                        </div>
                                        <td class="align-middle text-center text-info">
                                            <a href="#" id="pay-button" class="badge badge-sm bg-gradient-success">Bayar</a>
                                        </td>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-0">
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
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url(); ?>/assets/js/material-dashboard.min.js?v=3.1.0"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-2eOepzVHxBxiOA3b"></script>
<script>
    $('#pay-button').click(function(e) {
        e.preventDefault();

        var token = '<?= $token ?>'; // Pastikan Anda telah mendefinisikan $token sebelumnya

        snap.pay(token, {
            onSuccess: function(result) {
                console.log(JSON.stringify(result, null, 2));
                sendCallback(result);
            },
            onPending: function(result) {
                console.log(JSON.stringify(result, null, 2));
                sendCallback(result);
            },
            onError: function(result) {
                console.log(JSON.stringify(result, null, 2));
                sendCallback(result);
            }
        });
    });

    function sendCallback(data) {
        var url = 'http://localhost:8808/callback'; // Ganti dengan URL API callback yang sesuai

        $.ajax({
            type: 'POST',
            url: url,
            contentType: 'application/json',
            data: JSON.stringify({
                transaction_status: data.transaction_status,
                order_id: data.order_id,
                fraud_status: data.fraud_status,
                payment_type: data.payment_type,
                gross_amount: data.gross_amount,
                transaction_time: data.transaction_time,
                transaction_id: data.transaction_id,
                status_message: data.status_message,
                va_numbers: data.va_numbers,
                bank: data.va_numbers[0].bank,
                va_number: data.va_numbers[0].va_number
            }),
            success: function(response) {
                console.log('Callback request sent successfully.');
            },
            error: function(error) {
                console.error('Failed to send callback request.');
            }
        });
    }
</script>
<?= $this->endSection() ?>