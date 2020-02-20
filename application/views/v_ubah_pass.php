<body>
    <div class="bg-login"></div>
    <div class="content changepass-parent">
        <form id="changepass-form" action="javascript:;" method="post" novalidate="novalidate">
            <div class="changepass-title">
                <img src="<?php echo base_url('assets/img/undip/logo-light-text2.png') ?>" alt="Universitas Diponegoro" style="width: 175px; vertical-align: middle">
                <h2 class="changepass-title1">Ubah Password Admin</h2>
            </div>
            <div class="social-auth-hr">
                <span>Mengubah password akun Admin</span>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password Lama">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="konfirmasi_password" placeholder="Password Baru">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <button class="btn btn-outline-primary btn-block" type="button" onclick="window.history.back()"><strong>Kembali</strong></button>
                    </div>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit"><strong>Submit</strong></button>
                    </div>
                </div>
            </div>
        </form>
    </div>