            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Daftar Penghuni<?php //echo $halaman ?></div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="tabel-penghuni" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 24.5px">No.</th>
                                    <th class="text-center">No. Kamar</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">No. HP</th>
                                    <th class="text-center">Alamat Asal</th>
                                    <th class="text-center">Nama Ortu</th>
                                    <th class="text-center">No. HP Ortu</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($penghuni as $penghuni){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $penghuni->no_kamar ?></td>
                                    <td class="text-center"><?php echo $penghuni->nama ?></td>
                                    <td class="text-center"><?php echo $penghuni->nim ?></td>
                                    <td class="text-center"><?php echo $penghuni->no ?></td>
                                    <td class="text-center"><?php echo $penghuni->alamat ?></td>
                                    <td class="text-center"><?php echo $penghuni->nama_ortu ?></td>
                                    <td class="text-center"><?php echo $penghuni->no_ortu ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-success active detail-penghuni" id="<?php echo $penghuni->id ?>">
                                            <span class="fa fa-info-circle"></span>
                                        </a>
                                        <a class="btn btn-sm btn-success active swal-penghuni" id="<?php echo $penghuni->id ?>">
                                            <span class="fa fa-info-circle"></span>
                                        </a>
                                        <a class="btn btn-sm btn-info active" href="<?php echo base_url('admin/edit_penghuni/'.$penghuni->id) ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        <a class="btn btn-sm btn-danger active hapus-penghuni" id="<?php echo $penghuni->id ?>">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
    <!-- Detail Popup -->
    <div id="dataModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Detail Penghuni</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detail_penghuni">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>