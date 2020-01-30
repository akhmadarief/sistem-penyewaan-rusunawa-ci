            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Riwayat Pembayaran<?php //echo $halaman ?></div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="tabel-penghuni" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 24.5px">No.</th>
                                    <th class="text-center">No. Kamar</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">Tanggal Pembayaran</th>
                                    <th class="text-center">Jumlah Harus Dibayar</th>
                                    <th class="text-center">Nominal Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($pembayaran as $pembayaran){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $pembayaran->no_kamar ?></td>
                                    <td class="text-center"><?php echo $pembayaran->nama ?></td>
                                    <td class="text-center"><?php echo $pembayaran->nim ?></td>
                                    <td class="text-center"><?php echo $pembayaran->tgl_bayar ?></td>
                                    <td class="text-center"><?php echo 'Rp. '.number_format($pembayaran->biaya, 0, ',', '.') ?></td>
                                    <td class="text-center"><?php echo 'Rp. '.number_format($pembayaran->bayar, 0, ',', '.') ?></td>
                                    <td class="text-center">Edit</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->