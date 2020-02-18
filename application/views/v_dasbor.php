<?php //$this->load->view('_partials/session.php') ?>

<?php //$halaman = 'Dasbor' ?>

<?php //$this->load->view('_partials/head.php') ?>

        <!-- START HEADER-->
        <?php //$this->load->view('_partials/header.php') ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php //$this->load->view('_partials/sidebar.php') ?>
        <!-- END SIDEBAR-->
            <!-- START PAGE CONTENT -->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Carousel Wrapper-->
                        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-2" data-slide-to="1"></li>
                                <li data-target="#carousel-example-2" data-slide-to="2"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/a.jpg')  ?>"
                                        alt="First slide">
                                        <div class="mask rgba-black-light"></div>
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive">Light mask</h3>
                                        <p>First text</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!--Mask color-->
                                    <div class="view">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/rusunawa01.jpg')  ?>"
                                        alt="Second slide">
                                        <div class="mask rgba-black-strong"></div>
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive">Strong mask</h3>
                                        <p>Secondary text</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!--Mask color-->
                                    <div class="view">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/rusunawa02.jpg')  ?>"
                                        alt="Third slide">
                                        <div class="mask rgba-black-slight"></div>
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive">Slight mask</h3>
                                        <p>Third text</p>
                                    </div>
                                </div>
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                            </div>
                            <!--/.Carousel Wrapper-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body sum-kamar">
                                <h4 class="m-b-5 font-strong">Gedung A</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (84 - $a['terisi2']) ?> Kamar</div><i class="widget-stat-icon icon-gedung"><img src="<?php echo base_url("assets/img/A.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (84 - $a['terisi2'] - $a['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 84 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body sum-kamar">
                                <h4 class="m-b-5 font-strong">Gedung B</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (97 - $b['terisi2']) ?> Kamar</div><i class="widget-stat-icon icon-gedung"><img src="<?php echo base_url("assets/img/B.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (97 - $b['terisi2'] - $b['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 97 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body sum-kamar">
                                <h4 class="m-b-5 font-strong">Gedung C</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (96 - $c['terisi2']) ?> Kamar</div><i class="widget-stat-icon icon-gedung"><img src="<?php echo base_url("assets/img/C.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (96 - $c['terisi2'] - $c['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 96 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body sum-kamar">
                                <h4 class="m-b-5 font-strong">Gedung D</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (103 - $d['terisi2']) ?> Kamar</div><i class="widget-stat-icon icon-gedung"><img src="<?php echo base_url("assets/img/D.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (103 - $d['terisi2'] - $d['terisi1']) ?> Kamar</div>
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 103 Kamar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat" style="background-color: #3498db;">
                            <div class="ibox-body sum-kamar">
                                <h4 class="m-b-5 font-strong">Gedung E</h4>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 1 Orang</label>: <?php echo (114 - $e['terisi2']) ?> Kamar</div><i class="widget-stat-icon icon-gedung"><img src="<?php echo base_url("assets/img/E.png"); ?>"/></i>
                                <div class="m-b-5"><label class="sum-gedung">Bisa diisi 2 Orang</label>: <?php echo (114 - $e['terisi2'] - $e['terisi1']) ?> Kamar</div>
                                <!--suatu saat dibutuhkan <div class="m-b-5"><label class="sum-gedung">Sendiri </label>: <?php echo $e['sendiri'] ?> Kamar</div> -->
                                <div class="m-b-5"><label class="sum-gedung">Total Kamar </label>: 114 Kamar</div>
                            </div>
                        </div>
                    </div>
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
