    <!-- CORE PLUGINS-->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/popper.js/dist/umd/popper.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/metisMenu/dist/metisMenu.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?php echo base_url('assets/js/app.min.js') ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="<?php echo base_url('assets/vendors/DataTables/datatables.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/sweetalert2/sweetalert2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.full.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
    <script type="text/javascript">
        //semua halaman
        $(document).ready(function(){
            $('#logout-alert').click(function(){
                Swal.fire({
                    title: 'Keluar dari Sistem',
                    text: 'Apakah Anda yakin ingin keluar dari sistem?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#dd3333',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Keluar',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        //form.submit();
                        window.location.href = '<?php echo base_url("login/logout") ?>';
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        //daftar penghuni
        $(document).ready(function(){
            $("#tabel-penghuni").DataTable({
                pageLength: 25
            });
            $(".hapus-penghuni").click(function(){
                var id_penghuni = $(this).attr('id');
                Swal.fire({
                    title: 'Hapus Data Penghuni',
                    text: 'Apakah Anda yakin ingin menghapus data penghuni ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dd3333',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        //form.submit();
                        window.location.href = '<?php echo base_url("aksi/aksi_hapus_penghuni/") ?>' + id_penghuni;
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        //tambah/edit penghuni
        $(document).ready(function(){
            // Select 2
            $(".select2_fakultas").select2({
                placeholder: "Pilih Fakultas",
                allowClear: true
            });
            $(".select2_prodi").select2({
                placeholder: "Pilih Prodi",
                allowClear: true
            });
            $(".select2_agama").select2({
                placeholder: "Pilih Agama",
                allowClear: true
            });
            // Get Prodi
            $("#fakultas").change(function(){
                var id_fakultas = $("#fakultas").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_prodi') ?>",
                    data: {id_fakultas: id_fakultas},
                    cache: false,
                    success: function(msg){
                    $("#prodi").html(msg);
                    }
                });
            });
            // Form Masks
            $("#form_tgl_lahir").mask("99-99-9999", {
                placeholder: "dd-mm-yyyy"
            });
            $("#tgl_masuk").mask("99-99-9999", {
                placeholder: "dd-mm-yyyy"
            });
            $("#tgl_keluar").mask("99-99-9999", {
                placeholder: "dd-mm-yyyy"
            });
            // Bootstrap datepicker
            $("#tgl_lahir .input-group.date").datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd-mm-yyyy"
            });
            $("#masa_huni .input-daterange").datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd-mm-yyyy"
            });
            // Agama lainnya
            $("#agama").change(function(){
                var agama = $("#agama").val();
                if (agama == "other"){
                    $("#agama_lainnya").attr("style", "display: block");
                }
                else {
                    $("#agama_lainnya").attr("style", "display: none");
                }
            });
        });
    </script>
    <script type="text/javascript">
        //pilih kamar
        $(document).ready(function(){
            $("#gedung_A").change(function(){
                var lantai = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    method: "POST",
                    data: {lantai: lantai},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        var html = '';
                        for (i=0; i<data.length; i++){
                            html += '<div class="kamar ' + data[i].status + '" id="' + data[i].no_kamar + '">' + data[i].no_kamar + '</div>';
                        }
                        $("#lantai_A").html(html);
                    }
                });
            }).trigger("change");
            $("#gedung_B").change(function(){
                var lantai = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    method: "POST",
                    data: {lantai: lantai},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        var html = '';
                        for (i=0; i<data.length; i++){
                            html += '<div class="kamar ' + data[i].status + '" id="' + data[i].no_kamar + '">' + data[i].no_kamar + '</div>';
                        }
                        $("#lantai_B").html(html);
                    }
                });
            }).trigger("change");
            $("#gedung_C").change(function(){
                var lantai = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    method: "POST",
                    data: {lantai: lantai},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        var html = '';
                        for (i=0; i<data.length; i++){
                            html += '<div class="kamar ' + data[i].status + '" id="' + data[i].no_kamar + '">' + data[i].no_kamar + '</div>';
                        }
                        $("#lantai_C").html(html);
                    }
                });
            }).trigger("change");
            $("#gedung_D").change(function(){
                var lantai = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    method: "POST",
                    data: {lantai: lantai},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        var html = '';
                        for (i=0; i<data.length; i++){
                            html += '<div class="kamar ' + data[i].status + '" id="' + data[i].no_kamar + '">' + data[i].no_kamar + '</div>';
                        }
                        $("#lantai_D").html(html);
                    }
                });
            }).trigger("change");
            $("#gedung_E").change(function(){
                var lantai = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    method: "POST",
                    data: {lantai: lantai},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        var html = '';
                        for (i=0; i<data.length; i++){
                            html += '<div class="kamar ' + data[i].status + '" id="' + data[i].no_kamar + '">' + data[i].no_kamar + '</div>';
                        }
                        $("#lantai_E").html(html);
                    }
                });
            }).trigger("change");
            //tampil data penghuni di denah kamar
            $(document).on("click", ".kamar", function(){
                $(".kamar").removeClass("terpilih");
                $(this).addClass("terpilih");
                $("#penghuni1").show();
                var no_kamar = $(this).attr("id");
                $("#no_kamar").val(no_kamar);
                $("#no_kamar2").val(no_kamar);
                $.ajax({
                    url: "<?php echo base_url('aksi/get_detail_kamar') ?>",
                    method: "POST",
                    data: {no_kamar: no_kamar},
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        if (!data[0]){
                            $("#penghuni2").removeAttr("style").hide();
                            $("#tambah_penghuni").show();
                            $("#tambah_penghuni").attr("href", "<?php echo base_url('admin/tambah_penghuni/') ?>" + no_kamar);
                            //$("#edit_penghuni").removeAttr("href");
                            $("#edit_penghuni").removeAttr("style").hide();
                            $("#nama").val("Belum ada penghuni");
                            $("#nim").val("Belum ada penghuni");
                            $("#no").val("Belum ada penghuni");
                            $("#prodi").val("Belum ada penghuni");
                            //$("#masa_huni").val("Belum ada penghuni");
                        }
                        else {
                            if (data[0].isi_kamar == "1") {
                                $("#penghuni2").removeAttr("style").hide(); // tidak tampil
                            }
                            else {
                                $("#penghuni2").show();
                            }
                            //$("#tambah_penghuni").removeAttr("href");
                            $("#tambah_penghuni").removeAttr("style").hide();
                            $("#edit_penghuni").show();
                            $("#edit_penghuni").attr("href", "<?php echo base_url('admin/edit_penghuni/') ?>" + data[0].id);
                            $("#nama").val(data[0].nama);
                            $("#nim").val(data[0].nim);
                            $("#no").val(data[0].no);
                            $("#prodi").val(data[0].id_prodi); //masih id prodi
                            //$("#masa_huni").val(data.masa_huni + " Tahun");
                        }
                        if (!data[1]){
                            $("#tambah_penghuni2").show();
                            $("#tambah_penghuni2").attr("href", "<?php echo base_url('admin/tambah_penghuni/') ?>" + no_kamar);
                            //$("#edit_penghuni2").removeAttr("href");
                            $("#edit_penghuni2").removeAttr("style").hide();
                            $("#nama2").val("Belum ada penghuni");
                            $("#nim2").val("Belum ada penghuni");
                            $("#no2").val("Belum ada penghuni");
                            $("#prodi2").val("Belum ada penghuni");
                            //$("#masa_huni2").val("Belum ada penghuni");
                        }
                        else {
                            //$("#tambah_penghuni2").removeAttr("href");
                            $("#tambah_penghuni2").removeAttr("style").hide();
                            $("#edit_penghuni2").show();
                            $("#edit_penghuni2").attr("href", "<?php echo base_url('admin/edit_penghuni/') ?>" + data[1].id);
                            $("#nama2").val(data[1].nama);
                            $("#nim2").val(data[1].nim);
                            $("#no2").val(data[1].no);
                            $("#prodi2").val(data[1].id_prodi);
                            //$("#masa_huni2").val(data.masa_huni + " Tahun");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>