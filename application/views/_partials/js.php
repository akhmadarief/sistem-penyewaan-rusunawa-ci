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
                        window.location.href = '<?php echo base_url("admin/hapus?id=") ?>' + id_penghuni;
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
                var lantai = $("#gedung_A").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    data: {lantai: lantai},
                    cache: false,
                    success: function(msg){
                    $("#lantai_A").html(msg);
                    }
                });
            }).trigger("change");
            $("#gedung_B").change(function(){
                var lantai = $("#gedung_B").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    data: {lantai: lantai},
                    cache: false,
                    success: function(msg){
                    $("#lantai_B").html(msg);
                    }
                });
            }).trigger("change");
            $("#gedung_C").change(function(){
                var lantai = $("#gedung_C").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    data: {lantai: lantai},
                    cache: false,
                    success: function(msg){
                    $("#lantai_C").html(msg);
                    }
                });
            }).trigger("change");
            $("#gedung_D").change(function(){
                var lantai = $("#gedung_D").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    data: {lantai: lantai},
                    cache: false,
                    success: function(msg){
                    $("#lantai_D").html(msg);
                    }
                });
            }).trigger("change");
            $("#gedung_E").change(function(){
                var lantai = $("#gedung_E").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('aksi/get_kamar') ?>",
                    data: {lantai: lantai},
                    cache: false,
                    success: function(msg){
                    $("#lantai_E").html(msg);
                    }
                });
            }).trigger("change");
            // $("#gedung_F").change(function(){
            //     var gedung_F = $("#gedung_F").val();
            //     $.ajax({
            //         type: "POST",
            //         url: "_action/get.php?gedung=F",
            //         data: {gedung_F: gedung_F},
            //         cache: false,
            //         success: function(msg){
            //         $("#lantai_F").html(msg);
            //         }
            //     });
            // }).trigger("change");;
        });
    </script>
</body>
</html>