            <!-- START PAGE CONTENT-->
            <?php
            $tanggal = (date('d-m-Y'))." ".date('H:i:s');
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Daftar Penghuni ".$tanggal.".xls");
            ?>
            
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">No. Kamar</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">No. HP</th>
                                    <th class="text-center">Alamat Asal</th>
                                    <th class="text-center">Nama Ortu</th>
                                    <th class="text-center">No. HP Ortu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($penghuni as $penghuni){ ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $penghuni->no_kamar ?></td>
                                    <td class="text-center"><?php echo $penghuni->nama ?></td>
                                    <td class="text-center"><?php echo $penghuni->no ?></td>
                                    <td class="text-center"><?php echo $penghuni->alamat ?></td>
                                    <td class="text-center"><?php echo $penghuni->nama_ortu ?></td>
                                    <td class="text-center"><?php echo $penghuni->no_ortu ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
            <!-- END PAGE CONTENT-->