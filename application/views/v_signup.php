<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login | Sistem Penyewaan Rusunawa</title>
    <!--FAV ICON-->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/img/undip/favicon1.png') ?>">
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/themify-icons/css/themify-icons.css') ?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php echo base_url('assets/css/pages/auth-light.css') ?>" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" />
</head>

<body>
    <div class="bg-login"></div>
    <div class="content register-parent">
        <form id="register-form" action="javascript:;" method="post" novalidate="novalidate">
            <div class="register-title">
                <img src="<?php echo base_url('assets/img/undip/logo-light-text2.png') ?>" alt="Universitas Diponegoro" style="width: 175px; vertical-align: middle">
                <h2 class="register-title1">Tambah User Admin</h2>
            </div>
            <div class="social-auth-hr">
                <span>Membuat akun Admin</span>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="nama" placeholder="Nama Admin">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Konfirmasi Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Buat Akun</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/popper.js/dist/umd/popper.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url('assets/vendors/jquery-validation/dist/jquery.validate.min.js') ?>" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?php echo base_url('assets/js/app-login.min.js') ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>