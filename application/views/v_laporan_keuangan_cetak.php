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
                                    <th class="text-center">Jumlah Harus Dibayar</th>
                                    <th class="text-center">Jumlah Telah Dibayar</th>
                                    <th class="text-center">Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($keuangan as $keuangan){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $keuangan->no_kamar ?></td>
                                    <td class="text-center"><?php echo $keuangan->nama ?></td>
                                    <td class="text-center"><?php echo $keuangan->nim ?></td>
                                    <td class="text-center"><?php echo 'Rp. '.number_format($keuangan->biaya, 0, ',', '.') ?></td>
                                    <td class="text-center"><?php echo 'Rp. '.number_format($keuangan->bayar, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <?php
                                        $piutang = $keuangan->biaya - $keuangan->bayar;
                                        echo $piutang == 0 ? '<span class="badge badge-success">Sudah Lunas</span>' : 'Rp. '.number_format($piutang, 0, ',', '.');
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

            <!-- END PAGE CONTENT-->
