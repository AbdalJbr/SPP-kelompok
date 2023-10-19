<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= site_url('admin') ?>">
            <img src="<?= base_url(); ?>/assets/img/Logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">ADM Mis.Raudlatul Atfal</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('admin') ?>">
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
                <a class="nav-link text-white active bg-gradient-dark shadow-dark" href="<?= site_url('studenttables2') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Student Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('transaction2') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('transactionhistory2') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">History</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= site_url('profile2') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
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
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Student Tables</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Create Student</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Create Student</h6>
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
                        <span class="d-sm-inline d-none"> <?= session()->get('name') ?> - Administrator</span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 mt-4 mb-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Create Student</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-2">
                            <form role="form" class="text-start" action="<?= site_url('save2') ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="input-group input-group-outline my-2">
                                    <label class="form-label" for="username">Name</label>
                                    <input type="name" class="form-control" name="name" id="name">
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password">Nis</label>
                                    <input type="nis" class="form-control" name="nis" id="nis">
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password"></label>
                                    <select type="kelas" class="form-control" name="kelas" id="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <option value="I A">I A</option>
                                        <option value="I B">I B</option>
                                        <option value="II A">II A</option>
                                        <option value="II B">II B</option>
                                        <option value="III A">III A</option>
                                        <option value="III B">III B</option>
                                        <option value="IV A">IV A</option>
                                        <option value="IV B">IV B</option>
                                        <option value="V A">V A</option>
                                        <option value="V B">V B</option>
                                        <option value="VI A">VI A</option>
                                        <option value="VI B">VI B</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password">Tahun Ajaran</label>
                                    <input type="tahunajaran" class="form-control" name="tahunajaran" id="tahunajaran">
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" />
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password">Biaya</label>
                                    <input type="biaya" class="form-control" name="biaya" id="biaya">
                                </div>
                                <div class="input-group input-group-outline mb-2">
                                    <label class="form-label" for="password"></label>
                                    <select type="role" class="form-control" name="role" id="role">
                                        <option value="">Akses User</option>
                                        <option value="siswa">siswa</option>
                                        <option value="admin">admin</option>
                                        <option value="superadmin">superadmin</option>
                                    </select>
                                </div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn bg-gradient-dark shadow-dark">Create</button>
                                </div>
                            </form>
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
    $(document).ready(function() {
        $("#tgl_lahir").datepicker({
            format: "ddmmyy"
        });
    })
</script>
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
<?= $this->endSection() ?>