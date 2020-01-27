<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class aksi extends CI_Controller {

    function __construct(){
        parent::__construct();
        if ($this->session->userdata('status') != 'login'){
            redirect (base_url('login'));
        }
        $this->load->model('m_data');
    }

    function get_prodi(){
        $id_fakultas =  $this->input->post('id_fakultas');
        $prodi = $this->m_data->data_prodi($id_fakultas);

        echo '<option></option>';
        foreach ($prodi->result() as $prodi){
            echo '<option value="'.$prodi->id_prodi.'">'.$prodi->nama_prodi.'</option>';
        }
    }

    function get_kamar(){
        $lantai = $this->input->post('lantai');
        $kamar = $this->m_data->data_kamar($lantai);

        foreach ($kamar->result() as $kamar){
            echo '<div class="kamar '.$kamar->status.'" id="'.$kamar->no_kamar.'">'.$kamar->no_kamar.'</div>';
        }
    }

    function get_detail_kamar(){
        $no_kamar = $this->input->post('no_kamar');
        $status = $this->input->post('status');
        $detail_kamar = $this->m_data->detail_kamar($no_kamar, $status);

        foreach ($detail_kamar->result() as $detail_kamar){
            echo json_encode($detail_kamar);
        }
    }
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".kamar").click(function (){
            $(".kamar").removeClass("terpilih");
            $(this).addClass("terpilih");
            $("#dataPenghuni1").show();
            var no_kamar = $(this).attr("id");
            $("#no_kamar").val(no_kamar);
            $("#no_kamar2").val(no_kamar);
            $.ajax({
                url: "http://localhost/sistem-penyewaan-rusunawa-ci/aksi/get_detail_kamar",
                method: "POST",
                data: {no_kamar: no_kamar, status: "Penghuni 1"},
                dataType: "json",
                success: function(data){
                    if(!data) {
                        $("#dataPenghuni2").removeAttr("style").hide();
                        $("#tambah_penghuni").show();
                        $("#tambah_penghuni").attr("href", "tambah_penghuni.php?kamar=" + no_kamar + "&status=Penghuni 1");
                        //$("#edit_penghuni").removeAttr("href");
                        $("#edit_penghuni").removeAttr("style").hide();
                        $("#nama").val("Belum ada penghuni");
                        $("#nim").val("Belum ada penghuni");
                        $("#no").val("Belum ada penghuni");
                        $("#prodi").val("Belum ada penghuni");
                        $("#masa_huni").val("Belum ada penghuni");
                    }
                    else {
                        if (data.isi_kamar == "1") {
                            $("#dataPenghuni2").removeAttr("style").hide(); // tidak tampil
                        }
                        else {
                            $("#dataPenghuni2").show();
                        }
                        //$("#tambah_penghuni").removeAttr("href");
                        $("#tambah_penghuni").removeAttr("style").hide();
                        $("#edit_penghuni").show();
                        $("#edit_penghuni").attr("href", "edit_penghuni.php?id=" + data.id);
                        $("#nama").val(data.nama);
                        $("#nim").val(data.nim);
                        $("#no").val(data.no);
                        $("#prodi").val(data.nama_prodi);
                        $("#masa_huni").val(data.masa_huni + " Tahun");
                    }
                }
            });
            $.ajax({
                url: "http://localhost/sistem-penyewaan-rusunawa-ci/aksi/get_detail_kamar",
                method: "POST",
                data: {no_kamar: no_kamar, status: "Penghuni 2"},
                dataType: "json",
                success: function(data){
                    if(!data) {
                        $("#tambah_penghuni2").show();
                        $("#tambah_penghuni2").attr("href", "tambah_penghuni.php?kamar=" + no_kamar + "&status=Penghuni 2");
                        //$("#edit_penghuni2").removeAttr("href");
                        $("#edit_penghuni2").removeAttr("style").hide();
                        $("#nama2").val("Belum ada penghuni");
                        $("#nim2").val("Belum ada penghuni");
                        $("#no2").val("Belum ada penghuni");
                        $("#prodi2").val("Belum ada penghuni");
                        $("#masa_huni2").val("Belum ada penghuni");
                    }
                    else {
                        //$("#tambah_penghuni2").removeAttr("href");
                        $("#tambah_penghuni2").removeAttr("style").hide();
                        $("#edit_penghuni2").show();
                        $("#edit_penghuni2").attr("href", "edit_penghuni.php?id=" + data.id);
                        $("#nama2").val(data.nama);
                        $("#nim2").val(data.nim);
                        $("#no2").val(data.no);
                        $("#prodi2").val(data.nama_prodi);
                        $("#masa_huni2").val(data.masa_huni + " Tahun");
                    }
                }
            });
        });
    });
</script>