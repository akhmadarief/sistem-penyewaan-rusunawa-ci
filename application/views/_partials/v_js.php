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
    <script src="<?php echo base_url('assets/vendors/DataTables/ColReorderWithResize.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>" type="text/javascript"></script>
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
            $('#tabel-penghuni').DataTable({
                pageLength: 25,
                'sDom': 'R<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"rt>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
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
        $(document).on("click", ".detail-penghuni", function(){
            var id_penghuni = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('aksi/detail_penghuni') ?>",
                method: "POST",
                data: {id_penghuni: id_penghuni},
                dataType: "json",
                cache: false,
                success: function(data){
                    Swal.fire({
                        html: `<div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="30%"><label>No. Kamar</label></td>
                                            <td width="70%">`+ data.no_kamar +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Nama</label></td>
                                            <td width="70%">`+ data.nama +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>NIM</label></td>
                                            <td width="70%">`+ data.nim +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Prodi</label></td>
                                            <td width="70%">`+ data.nama_prodi +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Tempat Lahir</label></td>
                                            <td width="70%">`+ data.tempat_lahir +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Tanggal Lahir</label></td>
                                            <td width="70%">`+ data.tgl_lahir +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Agama</label></td>
                                            <td width="70%">`+ data.agama +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Alamat Asal</label></td>
                                            <td width="70%">`+ data.alamat +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>No. Telp/HP</label></td>
                                            <td width="70%">`+ data.no +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Nama Orang Tua</label></td>
                                            <td width="70%">`+ data.nama_ortu +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Pekerjaan Orang Tua</label></td>
                                            <td width="70%">`+ data.pekerjaan_ortu +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Alamat Orang Tua</label></td>
                                            <td width="70%">`+ data.alamat_ortu +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>No. Telp/HP Orang Tua</label></td>
                                            <td width="70%">`+ data.no_ortu +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Kategori</label></td>
                                            <td width="70%">`+ data.kategori +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Tanggal Huni</label></td>
                                            <td width="70%">`+ data.tgl_masuk +` s/d `+ data.tgl_keluar +`</td>
                                        </tr>
                                        <tr>
                                            <td width="30%"><label>Masa Huni</label></td>
                                            <td width="70%">`+ data.masa_huni +`</td>
                                        </tr>
                                    </table>
                                </div>`
                    });
                }
            });
        });
        $(document).on("click", ".riwayat-bayar", function(){
            var id_penghuni = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('aksi/detail_penghuni') ?>",
                method: "POST",
                data: {id_penghuni: id_penghuni},
                dataType: "json",
                cache: false,
                success: function(data){
                    Swal.fire({
                        width: 1200,
                        html: `<div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="10%"><label>Masa Huni</label></td>
                                            <td width="10%"><label>Total Biaya</label></td>
                                            <td width="5%"><label>Agu</label></td>
                                            <td width="5%"><label>Sep</label></td>
                                            <td width="5%"><label>Okt</label></td>
                                            <td width="5%"><label>Nov</label></td>
                                            <td width="5%"><label>Des</label></td>
                                            <td width="5%"><label>Jan</label></td>
                                            <td width="5%"><label>Feb</label></td>
                                            <td width="5%"><label>Mar</label></td>
                                            <td width="5%"><label>Apr</label></td>
                                            <td width="5%"><label>Mei</label></td>
                                            <td width="5%"><label>Jun</label></td>
                                            <td width="5%"><label>Jul</label></td>
                                            <td width="10%"><label>Total Bayar</label></td>
                                            <td width="10%"><label>Piutang</label></td>
                                        </tr>
                                    </table>
                                </div>`
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        //tambah/edit penghuni
        $(document).ready(function(){
            // Select 2
            $(".select2_kamar").select2({
                placeholder: "Pilih Kamar Baru",
                allowClear: true
            });
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
            $(".select2_masa_huni").select2({
                placeholder: "Pilih Lama Huni Berdasarkan Tanggal Masuk dan Keluar",
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
            $("#tgl_huni .input-daterange").datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd-mm-yyyy"
            });
            // Agama lainnya
            $("#agama").change(function(){
                if ($("#agama").val() == "other"){
                    $("#agama_lainnya").show();
                }
                else {
                    $("#agama_lainnya").hide();
                }
            });
            //harga kamar
            $("#masa_huni").change(function(){
                var harga = parseInt($("#harga_kamar").val());
                var lama = parseInt($(this).val());
                total = harga*lama;
                $("#biaya").val(total);
            });
            $("#bayar").on("keyup", function(){
                var biaya =parseInt($("#biaya").val());
                var bayar =parseInt($(this).val());
                piutang = biaya-bayar;
                $("#piutang").val(piutang);
            });
        });
        $(document).ready(function(){
            $(".btn-edit").click(function(){
                $("#pilihan1").val("typo");
                $(".typo").show();
                $(".transaksi").hide();
                $(".pk").hide();
                if ($("#agama").val() == "other"){
                    $("#agama_lainnya").show();
                }
                else {
                    $("#agama_lainnya").hide();
                }
                $("#nama").removeAttr("disabled");
                $("#nim").removeAttr("disabled");
            }).trigger("click");;
            $(".btn-trans").click(function(){
                $("#pilihan1").val("transaksi");
                $(".typo").hide();
                $(".transaksi").show();
                $(".pk").hide();
                $("#agama_lainnya").hide();
                $("#nama").attr("disabled", "disabled");
                $("#nim").attr("disabled", "disabled");
            });
            $(".btn-pindah").click(function(){
                $("#pilihan1").val("pk");
                $(".typo").hide();
                $(".transaksi").hide();
                $(".pk").show();
                $("#agama_lainnya").hide();
                $("#nama").attr("disabled", "disabled");
                $("#nim").attr("disabled", "disabled");
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
                            html += '<div class="kamar '+ data[i].status +' '+ data[i].status_k +'" id="'+ data[i].no_kamar +'">'+ data[i].no_kamar +'</div>';
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
                            html += '<div class="kamar '+ data[i].status +' '+ data[i].status_k +'" id="'+ data[i].no_kamar +'">'+ data[i].no_kamar +'</div>';
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
                            html += '<div class="kamar '+ data[i].status +' '+ data[i].status_k +'" id="'+ data[i].no_kamar +'">'+ data[i].no_kamar +'</div>';
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
                            html += '<div class="kamar '+ data[i].status +' '+ data[i].status_k +'" id="'+ data[i].no_kamar +'">'+ data[i].no_kamar +'</div>';
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
                            html += '<div class="kamar '+ data[i].status +' '+ data[i].status_k +'" id="'+ data[i].no_kamar +'">'+ data[i].no_kamar +'</div>';
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
                $("#nama").val("Memuat ...");
                $("#nim").val("Memuat ...");
                $("#no").val("Memuat ...");
                $("#prodi").val("Memuat ...");
                $("#nama2").val("Memuat ...");
                $("#nim2").val("Memuat ...");
                $("#no2").val("Memuat ...");
                $("#prodi2").val("Memuat ...");
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
                            $("#tgl_masuk").val("");
                            $("#tgl_keluar").val("");
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
                            $("#prodi").val(data[0].nama_prodi);
                            $("#tgl_masuk").val(data[0].tgl_masuk);
                            $("#tgl_keluar").val(data[0].tgl_keluar);
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
                            $("#tgl_masuk2").val("");
                            $("#tgl_keluar2").val("");
                        }
                        else {
                            //$("#tambah_penghuni2").removeAttr("href");
                            $("#tambah_penghuni2").removeAttr("style").hide();
                            $("#edit_penghuni2").show();
                            $("#edit_penghuni2").attr("href", "<?php echo base_url('admin/edit_penghuni/') ?>" + data[1].id);
                            $("#nama2").val(data[1].nama);
                            $("#nim2").val(data[1].nim);
                            $("#no2").val(data[1].no);
                            $("#prodi2").val(data[1].nama_prodi);
                            $("#tgl_masuk2").val(data[1].tgl_masuk);
                            $("#tgl_keluar2").val(data[1].tgl_keluar);
                        }
                    }
                });
            });
        });
    </script>
    <script>
          var slideIndex = 0;
          showSlides();

          function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 3000); // Change image every 2 seconds
          }
    </script>
</body>
</html>
