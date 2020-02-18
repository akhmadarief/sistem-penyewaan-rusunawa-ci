<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aksi extends CI_Controller {

    function __construct(){
        parent::__construct();
        if ($this->session->userdata('status') != 'login'){
            redirect (base_url('login'));
        }
        $this->load->model('m_data');
    }

    function get_prodi(){
        $id_fakultas =  $this->input->post('id_fakultas');
        $prodi = $this->m_data->data_prodi_by_id_fakultas($id_fakultas);

        echo '<option></option>';
        foreach ($prodi->result() as $prodi){
            echo '<option value="'.$prodi->id_prodi.'">'.$prodi->nama_prodi.'</option>';
        }
    }

    function get_kamar(){
        $lantai = $this->input->post('lantai');
        $kamar = $this->m_data->data_kamar_by_lantai($lantai);

        echo json_encode($kamar->result());
    }

    function get_detail_kamar(){
        $no_kamar = $this->input->post('no_kamar');
        $detail_kamar = $this->m_data->data_penghuni_by_kamar($no_kamar);

        echo json_encode ($detail_kamar->result());
    }

    function aksi_tambah_penghuni(){
        $no_kamar       = $this->input->post('no_kamar');
        $isi_kamar      = $this->input->post('isi_kamar');
        $nama           = $this->input->post('nama');
        $nim            = $this->input->post('nim');
        $id_fakultas    = $this->input->post('id_fakultas');
        $id_prodi       = $this->input->post('id_prodi');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $agama          = ($this->input->post('agama') != 'other') ? $this->input->post('agama') : $this->input->post('agama_lainnya');
        $alamat         = $this->input->post('alamat');
        $no             = $this->input->post('no');
        $nama_ortu      = $this->input->post('nama_ortu');
        $pekerjaan_ortu = $this->input->post('pekerjaan_ortu');
        $alamat_ortu    = $this->input->post('alamat_ortu');
        $no_ortu        = $this->input->post('no_ortu');
        $kategori       = $this->input->post('kategori');
        $tgl_masuk      = $this->input->post('tgl_masuk');
        $tgl_keluar     = $this->input->post('tgl_keluar');
        $masa_huni      = $this->input->post('masa_huni');
        $biaya          = $this->input->post('biaya');
        $bayar          = $this->input->post('bayar');
        $piutang        = $this->input->post('piutang');

        $data = array(
            'no_kamar'      => $no_kamar,
            'isi_kamar'     => $isi_kamar,
            'nama'          => $nama,
            'nim'           => $nim,
            'id_fakultas'   => $id_fakultas,
            'id_prodi'      => $id_prodi,
            'tempat_lahir'  => $tempat_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'agama'         => $agama,
            'alamat'        => $alamat,
            'no'            => $no,
            'nama_ortu'     => $nama_ortu,
            'pekerjaan_ortu'=> $pekerjaan_ortu,
            'alamat_ortu'   => $alamat_ortu,
            'no_ortu'       => $no_ortu,
            'kategori'      => $kategori,
            'tgl_masuk'     => $tgl_masuk,
            'tgl_keluar'    => $tgl_keluar,
            'biaya'         => $biaya,
            'status'        => 'Penghuni'
        );

        $data_pembayaran = array(
            'nim'           => $nim,
            'tgl_bayar'     => $tgl_masuk,
            'bayar'         => $bayar
        );

        $kamar = $this->m_data->cek_kamar($no_kamar)->row();

        if ($kamar->status == 'sendiri' or $kamar->status == 'terisi2'){
            echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';
        }
        else if ($this->m_data->insert_penghuni($data) == true){

            if ($kamar->status == 'kosong' and $isi_kamar == '2') $status_kamar = 'terisi1';

            else if ($kamar->status == 'kosong' and $isi_kamar == '1') $status_kamar = 'sendiri';

            else if ($kamar->status == 'terisi1') $status_kamar = 'terisi2';

            if ($piutang != 0) $status_bayar = 'piutang';

            else if ($piutang == 0) $status_bayar = 'lunas';

            $this->m_data->update_status_kamar($no_kamar, $status_kamar, $status_bayar);
            $this->m_data->insert_pembayaran($data_pembayaran);

            //redirect('admin/pilih_kamar');
            echo 'berhasil disimpan gan';
            //redirect('admin/pilih_kamar');
        }
        else {
            echo 'gagal disimpan gan :(';
        }
    }

    function aksi_edit_penghuni(){
        $id             = $this->input->post('id');
        $no_kamar_lama  = $this->input->post('no_kamar_lama');
        $no_kamar       = $this->input->post('no_kamar');
        //echo $no_kamar; exit;
        $isi_kamar      = $this->input->post('isi_kamar');
        $nama           = $this->input->post('nama');
        $nim            = $this->input->post('nim');
        $id_fakultas    = $this->input->post('id_fakultas');
        $id_prodi       = $this->input->post('id_prodi');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $agama          = ($this->input->post('agama') != 'other') ? $this->input->post('agama') : $this->input->post('agama_lainnya');
        $alamat         = $this->input->post('alamat');
        $no             = $this->input->post('no');
        $nama_ortu      = $this->input->post('nama_ortu');
        $pekerjaan_ortu = $this->input->post('pekerjaan_ortu');
        $alamat_ortu    = $this->input->post('alamat_ortu');
        $no_ortu        = $this->input->post('no_ortu');
        $tgl_masuk      = $this->input->post('tgl_masuk');
        $tgl_keluar     = $this->input->post('tgl_keluar');
        $kategori       = $this->input->post('kategori');
        $biaya          = $this->input->post('biaya'); //belum dipakai
        $bayar          = $this->input->post('bayar');
        $piutang        = $this->input->post('piutang'); //belum dipakai
        $pilihan        = $this->input->post('pilihan1');
        $kamar = $this->m_data->cek_kamar($no_kamar_lama)->row();
        //echo "a".$kamar->status;exit;

        $data = array(
            'no_kamar'      => $no_kamar,
            'isi_kamar'     => $isi_kamar,
            'nama'          => $nama,
            'nim'           => $nim,
            'id_fakultas'   => $id_fakultas,
            'id_prodi'      => $id_prodi,
            'tempat_lahir'  => $tempat_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'agama'         => $agama,
            'alamat'        => $alamat,
            'no'            => $no,
            'nama_ortu'     => $nama_ortu,
            'pekerjaan_ortu'=> $pekerjaan_ortu,
            'alamat_ortu'   => $alamat_ortu,
            'no_ortu'       => $no_ortu,
            'tgl_masuk'     => $tgl_masuk,
            'tgl_keluar'    => $tgl_keluar,
            'kategori'      => $kategori
        );

        $data_pembayaran = array(
            'nim'           => $nim,
            'tgl_bayar'     => date("d-m-Y"),
            'bayar'         => $bayar
        );

        $data_pindah_kamar = array(
            'no_kamar'      => $no_kamar
        );

        switch ($pilihan) {
            case "typo":
                $this->m_data->update_penghuni($id, $data);
                redirect('admin/daftar_penghuni');
                //echo $this->db->last_query();
                //exit;
            break;

            case "transaksi":
                $this->m_data->update_penghuni($id, $data);
                $this->m_data->insert_pembayaran($data_pembayaran);
                redirect('admin/daftar_penghuni');
            break;

            case "pk":              
                $this->m_data->update_penghuni($id, $data_pindah_kamar);
                $status_kamar_lama = $this->m_data->cek_kamar($no_kamar_lama)->row();
                $status_kamar_baru = $this->m_data->cek_kamar($no_kamar)->row();
                
                //blok kamar baru
                if ($status_kamar_lama ='terisi1' || $status_kamar_lama = 'terisi1 piutang') {
                    $this->m_data->update_status_kamar($no_kamar_lama, 'kosong');
                }
                else if($status_kamar_lama ='terisi2' || $status_kamar_lama = 'terisi2 piutang'){
                    $this->m_data->update_status_kamar($no_kamar_lama, 'terisi1');                      //masih belum bisa membedakan piutang
                }
                else {
                    echo "kosong tau error gan :(";
                }
                //

                //blok kamar lama
                if($status_kamar_baru = 'terisi1' || $status_kamar_baru = 'terisi1 piutang' || $status_kamar_baru = 'sendiri'){
                    $this->m_data->update_status_kamar($no_kamar, 'kosong');
                }

                if($status_kamar_baru = 'terisi2' || $status_kamar_baru = 'terisi2 piutang'){
                    $this->m_data->update_status_kamar($no_kamar, 'terisi1');                           //masih belum bisa membedakan piutang
                }
                else {
                    echo "error gan :(";
                }
                //
                echo $this->db->last_query();
                exit;
                redirect('admin/daftar_penghuni');
            break;
            default:
            echo "error gan :/";exit;
        break;
        }

        
//ini baru
        //$this->m_data->update_penghuni($id, $data);

//sampai sini


        // if ($this->m_data->update_penghuni($id, $data) == true){
        //     //redirect('admin/daftar_penghuni');
        //     echo 'berhasil diupdate gan';
        //     redirect('admin/daftar_penghuni');
        // }
        // else {
        //     echo 'gagal gan :(';
        // }
    }

    function aksi_hapus_penghuni($id = null){

        if (!isset($id)) redirect('admin/daftar_penghuni');

        $penghuni = $this->m_data->data_penghuni_by_id($id)->row();

        if (!$penghuni){
            show_404();
        }
        else if ($this->m_data->delete_penghuni($id) == true){

            $no_kamar = $penghuni->no_kamar;
            $nim = $penghuni->nim;
            $kamar = $this->m_data->cek_kamar($no_kamar)->row();

            $cek_penghuni = $this->m_data->data_keuangan_per_penghuni_by_nim($nim)->row();

            switch ($kamar->status){
                case 'sendiri':
                    $status_kamar = 'kosong';
                    $status_bayar = 'lunas';
                break;

                case 'terisi1':
                    $status_kamar = 'kosong';
                    $status_bayar = 'lunas';
                break;

                case 'terisi2':
                    $status_kamar = 'terisi1';

                    if (!$cek_penghuni){
                        $status_bayar = 'lunas';
                    }
                    else {
                        $piutang = $cek_penghuni->biaya - $penghuni_lain->bayar;
                        $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
                    }
                break;
            }

            // if ($kamar->status == 'sendiri'){
            //     $status_kamar = 'kosong';
            //     $status_bayar = 'lunas';
            // }

            // else if ($kamar->status == 'terisi1'){
            //     $status_kamar = 'kosong';
            //     $status_bayar = 'lunas';
            // }

            // else if ($kamar->status == 'terisi2'){
            //     $status_kamar = 'terisi1';

            //     if (!$cek_penghuni){
            //         $status_bayar = 'lunas';
            //     }
            //     else {
            //         $piutang = $cek_penghuni->biaya - $penghuni_lain->bayar;
            //         $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
            //     }
            // }

            $this->m_data->update_status_kamar($no_kamar, $status_kamar);

            //redirect('admin/daftar_penghuni');
            echo 'berhasil dihapus gan';
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function detail_penghuni(){
        $id = $this->input->post('id_penghuni');
        $penghuni = $this->m_data->data_penghuni_by_id($id)->row();
        echo json_encode($penghuni);
    }
}
