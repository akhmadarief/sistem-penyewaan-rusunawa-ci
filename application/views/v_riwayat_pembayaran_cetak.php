            <!-- START PAGE CONTENT-->
            <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=hasil.xls");
            ?>
                        <table>
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

            <!-- END PAGE CONTENT-->