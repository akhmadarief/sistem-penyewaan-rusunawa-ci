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

        $status_awal_kamar = ($this->m_data->cek_kamar($no_kamar)->row())->status;

        if ($status_awal_kamar == 'sendiri' or $status_awal_kamar == 'terisi2'){
            echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';
        }
        else if ($this->m_data->insert_penghuni($data) == true){

            if ($status_awal_kamar == 'kosong' and $isi_kamar == '2') $status_kamar = 'terisi1';

            else if ($status_awal_kamar == 'kosong' and $isi_kamar == '1') $status_kamar = 'sendiri';

            else if ($status_awal_kamar == 'terisi1') $status_kamar = 'terisi2';

            $cek_penghuni = $this->m_data->data_keuangan_per_penghuni_by_nim($nim)->row();

            if (!$cek_penghuni){
                $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
            }
            else {
                $piutang_penghuni_lain = $cek_penghuni->biaya - $cek_penghuni->bayar;
                $status_bayar = ($piutang == 0 and $piutang_penghuni_lain == 0) ? 'lunas' : 'piutang';
            }

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
        $no_kamar_baru  = $this->input->post('no_kamar_baru');
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
        $tgl_bayar      = $this->input->post('tgl_bayar');
        $biaya          = $this->input->post('biaya'); //belum dipakai
        $bayar          = $this->input->post('bayar');
        $piutang        = $this->input->post('piutang'); //belum dipakai
        $pilihan        = $this->input->post('pilihan1');
        $status_bayar   = null;
        $kamar = $this->m_data->cek_kamar($no_kamar_lama)->row();
        //echo "a".$kamar->status;exit;

        $data = array(
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
            'tgl_bayar'     => $tgl_bayar,
            'bayar'         => $bayar
        );

        $data_pindah_kamar = array(
            'no_kamar'      => $no_kamar_baru
        );

        
        if ($piutang != 0 || $piutang==null) $status_bayar = 'piutang';

        switch ($pilihan) {
            case "typo":
                if ($this->m_data->update_penghuni($id, $data) == true){
                    //redirect('admin/daftar_penghuni');
                    //echo $this->db->last_query();
                    //exit;
                    echo 'data berhasil diperbarui';
                }
                else {
                    echo 'gagal gan wokwokwok';
                }
            break;

            case "transaksi":
                if ($this->m_data->insert_pembayaran($data_pembayaran) == true){
                    //redirect('admin/daftar_penghuni');
                    echo 'transaksi sukses gayn';
                }
                else {
                    echo 'transaksi gagal wkwkwk';
                }
            break;

            case "pk":              
                // $this->m_data->update_penghuni($id, $data_pindah_kamar);
                // $status_kamar_lama = ($this->m_data->cek_kamar($no_kamar_lama)->row())->status;
                // $status_kamar_baru = ($this->m_data->cek_kamar($no_kamar_baru)->row())->status;

                // //echo "statuskamarbaru:".$status_kamar_baru.($this->m_data->cek_kamar($no_kamar)->row())->no_kamar;
                // //echo "\nstatuskamarlama:".$status_kamar_lama.($this->m_data->cek_kamar($no_kamar_lama)->row())->no_kamar;
                // //exit;
                
                // //blok kamar lama
                // if ($status_kamar_lama =='terisi1') {
                //     $this->m_data->update_status_kamar($no_kamar_lama, 'kosong', $status_bayar);
                // }
                // else if($status_kamar_lama =='terisi2'){
                //     $this->m_data->update_status_kamar($no_kamar_lama, 'terisi1', $status_bayar);                      //masih belum bisa membedakan piutang //oke
                // }
                // else if($status_kamar_lama =='sendiri'){
                //     $this->m_data->update_status_kamar($no_kamar_lama, 'kosong', $status_bayar);                      
                // }
                // else {
                //     echo "kosong atau error gan :(";
                // }
                // //
                // //echo "\n".$this->db->last_query();
                // //blok kamar baru
                // if($status_kamar_baru == 'kosong'){
                //     if($status_kamar_lama == 'sendiri') {
                //         $this->m_data->update_status_kamar($no_kamar_baru, 'sendiri', $status_bayar);
                //     }
                //     else if($status_kamar_lama == 'terisi1' || $status_kamar_lama == 'terisi2') {
                //         if($status_kamar_baru == 'kosong'){
                //             $this->m_data->update_status_kamar($no_kamar_baru, 'terisi1', $status_bayar);
                //         }
                //         else if($status_kamar_baru == 'terisi1' ){
                //             $this->m_data->update_status_kamar($no_kamar_baru, 'terisi2', $status_bayar);
                //         }
                //     }
                // }
                // else if($status_kamar_baru == 'terisi1'){
                //     $this->m_data->update_status_kamar($no_kamar, 'terisi2', $status_bayar);
                // }
                // else {
                //     echo "error gan :(";
                // }
                // //
                // //echo "\n".$this->db->last_query();
                // //exit;
                // redirect('admin/daftar_penghuni');
                
                $this->m_data->update_penghuni($id, $data_pindah_kamar);

                $status_awal_kamar_lama = ($this->m_data->cek_kamar($no_kamar_lama)->row())->status;
                $status_awal_kamar_baru = ($this->m_data->cek_kamar($no_kamar_baru)->row())->status;

                switch ($status_awal_kamar_lama){
                    case 'sendiri':
                        $status_kamar_lama = 'kosong';
                        $status_bayar_kamar_lama = 'lunas';
                    break;
    
                    case 'terisi1':
                        $status_kamar_lama = 'kosong';
                        $status_bayar_kamar_lama = 'lunas';
                    break;
    
                    case 'terisi2':
                        $status_kamar_lama = 'terisi1';
                        $cek_penghuni_kamar_lama = $this->m_data->data_keuangan_per_penghuni_by_nim($nim)->row();

                        if (!$cek_penghuni_kamar_lama){
                            $status_bayar_kamar_lama = 'lunas';
                        }
                        else {
                            $piutang_penghuni_lain_lama = $cek_penghuni_kamar_lama->biaya - $cek_penghuni_kamar_lama->bayar;
                            $status_bayar_kamar_lama = ($piutang_penghuni_lain_lama == 0) ? 'lunas' : 'piutang';
                        }
                    break;
                }

                // switch ($status_awal_kamar_baru){
                //     case 'kosong':
                //         $status_kamar_baru = ($isi_kamar == '2') ? 'terisi1' : 'sendiri';
                //     break;

                //     case 'terisi1':
                //         $status_kamar_baru = 'terisi2';
                //     break;
                // }
                if ($status_awal_kamar_baru == 'kosong' and $isi_kamar == '2') $status_kamar_baru = 'terisi1';

                else if ($status_awal_kamar == 'kosong' and $isi_kamar == '1') $status_kamar_baru = 'sendiri';

                else if ($status_awal_kamar == 'terisi1') $status_kamar = 'terisi2';

                $cek_penghuni_kamar_baru = $this->m_data->data_keuangan_per_penghuni_by_nim($nim)->row();
                $penghuni_sekarang = $this->m_data->data_keuangan_per_penghuni_by_nim_2($nim)->row();

                $piutang = $penghuni_sekarang->biaya - $penghuni_sekarang->bayar;

                if (!$cek_penghuni_kamar_baru){
                    $status_bayar_kamar_baru = ($piutang == 0) ? 'lunas' : 'piutang';
                }
                else {
                    $piutang_penghuni_lain_baru = $cek_penghuni_kamar_baru->biaya - $cek_penghuni_kamar_baru->bayar;
                    $status_bayar_kamar_baru = ($piutang == 0 and $piutang_penghuni_lain_baru == 0) ? 'lunas' : 'piutang';
                }

                $this->m_data->update_status_kamar($no_kamar_lama, $status_kamar_lama, $status_bayar_kamar_lama);
                $this->m_data->update_status_kamar($no_kamar_baru, $status_kamar_baru, $status_bayar_kamar_baru);

                //echo $piutang;
                //echo $nim;

                echo 'berhasil pindah kamar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';

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
                        $piutang = $cek_penghuni->biaya - $cek_penghuni->bayar;
                        $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
                    }
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $status_kamar, $status_bayar);

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
