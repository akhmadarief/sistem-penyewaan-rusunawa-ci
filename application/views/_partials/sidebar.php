        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?php echo base_url('assets/img/admin-avatar.png') ?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $this->session->userdata('nama') ?></div><small><?php echo $this->session->userdata('username') ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="<?php //if ($halaman == 'Dasbor') echo 'active' ?>" href="<?php echo base_url('admin/dasbor') ?>"><i class="sidebar-item-icon fa fa-dashboard"></i>
                            <span class="nav-label">Dasbor</span>
                        </a>
                    </li>
                    <li class="heading">KAMAR</li>
                    <li>
                        <a class="<?php //if ($halaman == 'Pilih Kamar') echo 'active' ?>" href="<?php echo base_url('admin/pilih_kamar') ?>"><i class="sidebar-item-icon fa fa-th"></i>
                            <span class="nav-label">Pilih Kamar</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php //if ($halaman == 'Daftar Kamar') echo 'active' ?>" href="<?php echo base_url('admin/daftar_kamar') ?>"><i class="sidebar-item-icon fa fa-th-list"></i>
                            <span class="nav-label">Daftar Kamar</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php //if ($halaman == 'Daftar Harga Kamar') echo 'active' ?>" href="<?php echo base_url('admin/daftar_harga') ?>"><i class="sidebar-item-icon fa fa-dollar"></i>
                            <span class="nav-label">Daftar Harga Kamar</span>
                        </a>
                    </li>
                    <li class="heading">PENGHUNI</li>
                    <li>
                        <a class="<?php //if ($halaman == 'Daftar Penghuni') echo 'active' ?>" href="<?php echo base_url('admin/daftar_penghuni') ?>"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Daftar Penghuni</span>
                        </a>
                    </li>
                    <li class="heading">KEUANGAN</li>
                    <li>
                        <a class="<?php //if ($halaman == 'Laporan Keuangan') echo 'active' ?>" href="<?php echo base_url('admin/laporan_keuangan') ?>"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Laporan Keuangan</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php //if ($halaman == 'Laporan Piutang') echo 'active' ?>" href="<?php echo base_url('admin/laporan_piutang') ?>"><i class="sidebar-item-icon fa fa-credit-card-alt"></i>
                            <span class="nav-label">Laporan Piutang</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/kosong') ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Kosong</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">