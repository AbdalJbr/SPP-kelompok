<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://2.bp.blogspot.com/-kPKImtMN0I4/WxJGAuI4rQI/AAAAAAAADv8/J1doK7vChhsw9zWjrXoAIt0d1ZXUqP0sQCLcBGAs/s1600/adm%2Btu.png');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 text-center">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                                <img src="<?= base_url(); ?>/assets/img/Logo.png" class="rounded w-35 p-3" alt="Cinque Terre">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="panel-body">
                                <?php if (isset($validation)) : ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form role="form" class="text-start" action="<?= base_url('login') ?>" method="post">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="username" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark shadow-dark w-100 my-4 mb-2">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer position-absolute bottom-2 py-2 w-100">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= date('Y'); ?> Lembaga Administrasi Pelajar Mis.Raudlatul Atfal</span>
                    </div>
                </div>
            </div>
        </footer>
</main>
<!--   Core JS Files   -->
<script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url(); ?>/assets/js/material-dashboard.min.js?v=3.1.0"></script>
<?= $this->endSection() ?>