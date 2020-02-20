            <!-- START PAGE CONTENT -->
            <div class="fade-in-up">
                <div class="row">
                    <div class="col-lg-12" style="padding: 0 0 15px 0;">
                            <!--Carousel Wrapper-->
                            <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive big-brand1">SELAMAT DATANG</h3>
                                        <p class="big-brand2">Administrator Rusunawa Universitas Diponegoro</p>
                                    </div>
                                    <div class="carousel-item active">
                                        <div class="view">
                                            <img class="d-block w-100" src="<?php echo base_url('assets/img/undip/1.jpg')  ?>"
                                            alt="First slide" size="40x40">
                                            <div class="mask rgba-black-light"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/.Slides-->
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!--/.Carousel Wrapper-->
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