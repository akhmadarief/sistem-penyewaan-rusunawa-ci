<?php //$this->load->view('_partials/session.php') ?>

<?php //$halaman = 'Dasbor' ?>

<?php //$this->load->view('_partials/head.php') ?>

        <!-- START HEADER-->
        <?php //$this->load->view('_partials/header.php') ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php //$this->load->view('_partials/sidebar.php') ?>
        <!-- END SIDEBAR-->
        <div style="position:relative; font-size:25px; text-align:center;">

        </div>
        <div class="st">
          <img src="<?php echo base_url('assets/img/a.jpg')  ?>" class="foto-awal">
        <div class="tulisan-foto-dalam">Sistem Penyewaan Rusunawa UNDIP</div>
        <div class="foto-doni">
        <img src="<?php echo base_url('assets/img/b.jpg')  ?>">
        </div>
        </div>


                <div class="statichehe">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body">
                                <h4 class="m-b-5 font-strong">Gedung A</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (84 - $a['terisi2']) ?> Kamar</div><i class="widget-stat-icon"><img src="<?php echo base_url("assets/img/A.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (84 - $a['terisi2'] - $a['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 84 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body">
                                <h4 class="m-b-5 font-strong">Gedung B</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (97 - $b['terisi2']) ?> Kamar</div><i class="widget-stat-icon"><img src="<?php echo base_url("assets/img/B.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (97 - $b['terisi2'] - $b['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 97 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body">
                                <h4 class="m-b-5 font-strong">Gedung C</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (96 - $c['terisi2']) ?> Kamar</div><i class="widget-stat-icon"><img src="<?php echo base_url("assets/img/C.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (96 - $c['terisi2'] - $c['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 96 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body">
                                <h4 class="m-b-5 font-strong">Gedung D</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (103 - $d['terisi2']) ?> Kamar</div><i class="widget-stat-icon"><img src="<?php echo base_url("assets/img/D.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (103 - $d['terisi2'] - $d['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 103 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body">
                                <h4 class="m-b-5 font-strong">Gedung E</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (114 - $e['terisi2']) ?> Kamar</div><i class="widget-stat-icon"><img src="<?php echo base_url("assets/img/E.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (114 - $e['terisi2'] - $e['terisi1']) ?> Kamar</div>
 <!--suatu saat dibutuhkan      <div class="m-b-5"><label class="sum-gedung">Sendiri </label>: <?php echo $e['sendiri'] ?> Kamar</div> -->
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 114 Kamar</div>
                            </div>
                        </div>
                    </div>

                </div>
                <style>
                    .visitors-table tbody tr td:last-child {
                        display: flex;
                        align-items: center;
                    }

                    .visitors-table .progress {
                        flex: 1;
                    }

                    .visitors-table .progress-parcent {
                        text-align: right;
                        margin-left: 10px;
                    }
                </style>
            </div>
            </div>


            <!-- END PAGE CONTENT-->
            <?php //$this->load->view('_partials/footer.php') ?>
    <!-- BEGIN THEME CONFIG PANEL-->
    <?php //$this->load->view('_partials/theme-config.php') ?>
    <!-- END THEME CONFIG PANEL-->

    <!-- BEGIN PAGA BACKDROPS-->
    <?php //$this->load->view('_partials/preloader.php') ?>
    <!-- END PAGA BACKDROPS-->

    <!-- CORE PLUGINS & SCRIPTS-->
    <?php //$this->load->view('_partials/js.php') ?>
