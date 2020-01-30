            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Laporan Keuangan<?php //echo $halaman ?></div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="tabel-penghuni" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 24.5px">No.</th>
                                    <th class="text-center">NIM Penghuni</th>
                                    <th class="text-center">Tanggal Bayar</th>
                                    <th class="text-center">Terbayar</th>
                                    <th class="text-center">Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($keuangan as $keuangan){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $keuangan->nim ?></td>
                                    <td class="text-center"><?php echo $keuangan->tgl_bayar ?></td>
                                    <td class="text-center"><?php echo $keuangan->bayar ?></td>
                                    <td class="text-center"><?php echo $keuangan->piutang ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->