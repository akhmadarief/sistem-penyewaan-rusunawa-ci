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
        $detail_kamar = $this->m_data->detail_penghuni(array('no_kamar' => $no_kamar, 'status' => 'Penghuni'));

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

        $status_awal_kamar = ($this->m_data->cek_kamar($no_kamar)->row())->status;

        if ($status_awal_kamar == 'sendiri' or $status_awal_kamar == 'terisi2'){
            echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';
        }
        else if ($this->m_data->insert_penghuni($data) == true){

            switch ($status_awal_kamar){
                case 'kosong':
                    $status_kamar = ($isi_kamar == '2') ? 'terisi1' : 'sendiri';
                break;

                case 'terisi1':
                    $status_kamar = 'terisi2';
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $status_kamar);

            redirect (base_url('admin/pilih_kamar'));
            //echo 'berhasil disimpan gan';
        }
        else {
            echo 'gagal disimpan gan :(';
        }
    }

    function aksi_edit_penghuni(){
        $id             = $this->input->post('id');
        $nama           = $this->input->post('nama');
        $nim            = $this->input->post('nim');
        $pilihan        = $this->input->post('pilihan1');

        switch ($pilihan){
            case "typo":
                $no_kamar       = $this->input->post('no_kamar_lama');
                $isi_kamar      = $this->input->post('isi_kamar');
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
                $biaya          = $this->input->post('biaya');

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
                    'kategori'      => $kategori,
                    'biaya'         => $biaya
                );

                if ($this->m_data->update_penghuni($id, $data) == true){
                    $data_update_kamar = array(
                        'status' => ($isi_kamar == '2') ? 'terisi1' : 'sendiri'
                    );
                    $this->m_data->update_status_kamar($no_kamar, $data_update_kamar);

                    redirect (base_url('admin/daftar_penghuni'));
                    //echo 'data berhasil diperbarui';
                }
                else {
                    echo 'gagal gan wokwokwok';
                }
            break;

            case "transaksi":
                $no_kamar = $this->input->post('no_kamar_lama');
                $tgl_bayar = $this->input->post('tgl_bayar');
                $bayar = $this->input->post('bayar');
                $ket = $this->input->post('ket');
                $data_pembayaran = array(
                    'id_penghuni'   => $id,
                    'tgl_bayar'     => $tgl_bayar,
                    'bayar'         => $bayar,
                    'ket'           => $ket
                );

                if ($this->m_data->insert_pembayaran($data_pembayaran) == true){
                    redirect (base_url('admin/riwayat_pembayaran'));
                    //echo 'transaksi sukses gayn';
                }
                else {
                    echo 'transaksi gagal wkwkwk';
                }
            break;

            case "pk":
                $no_kamar_lama = $this->input->post('no_kamar_lama');
                $no_kamar_baru = $this->input->post('no_kamar_baru');

                $status_awal_kamar_lama = ($this->m_data->cek_kamar($no_kamar_lama)->row())->status;
                $status_awal_kamar_baru = ($this->m_data->cek_kamar($no_kamar_baru)->row())->status;

                switch ($status_awal_kamar_lama){
                    case 'sendiri':
                    case 'terisi1':
                        $status_kamar_lama = 'kosong';
                    break;

                    case 'terisi2':
                        $status_kamar_lama = 'terisi1';
                    break;
                }

                $penghuni_sekarang = $this->m_data->detail_penghuni(array('id' => $id))->row();

                switch ($status_awal_kamar_baru){
                    case 'kosong':
                        $isi_kamar = $penghuni_sekarang->isi_kamar;
                        $status_kamar_baru = ($penghuni_sekarang->isi_kamar == '2') ? 'terisi1' : 'sendiri';
                    break;

                    case 'terisi1':
                        $isi_kamar = '2';
                        $status_kamar_lama = 'terisi2';
                    break;
                }

                $data_pindah_kamar = array(
                    'no_kamar' => $no_kamar_baru,
                    'isi_kamar' => $isi_kamar
                );

                $this->m_data->update_penghuni($id, $data_pindah_kamar);
                $this->m_data->update_status_kamar($no_kamar_lama, $status_kamar_lama);
                $this->m_data->update_status_kamar($no_kamar_baru, $status_kamar_baru);

                //echo 'berhasil pindah kamar';
                redirect (base_url('admin/daftar_penghuni'));
            break;

            default:
                echo "error gan :/";exit;
            break;
        }
    }

    function aksi_hapus_penghuni($id = null){

        if (!isset($id)) redirect (base_url('admin/daftar_penghuni'));

        $penghuni = $this->m_data->detail_penghuni(array('id' => $id))->row();

        if (!$penghuni){
            show_404();
        }
        else if ($this->m_data->delete_penghuni($id) == true){

            $no_kamar = $penghuni->no_kamar;
            $kamar = $this->m_data->cek_kamar($no_kamar)->row();

            switch ($kamar->status){
                case 'sendiri':
                case 'terisi1':
                    $status_kamar = 'kosong';
                break;

                case 'terisi2':
                    $status_kamar = 'terisi1';
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $status_kamar);

            redirect (base_url('admin/daftar_penghuni'));
            //echo 'berhasil dihapus gan';
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function perpanjang($id = null){

        if (!isset($id)) redirect (base_url('admin/pilih_kamar'));

        $penghuni = $this->m_data->detail_penghuni(array('id' => $id))->row();

        if (!$penghuni){
            show_404();
        }

        else {
            $harga_kamar = (($this->m_data->data_harga_kamar_by_no_kamar($penghuni->no_kamar)->row())->harga)*12/($penghuni->isi_kamar);
            $biaya_lama = $penghuni->biaya;
            $biaya_baru = $biaya_lama + $harga_kamar;

            $tgl_keluar_lama = date('d-m-Y', strtotime($penghuni->tgl_keluar));
            $tgl_keluar_baru = date('d-m-Y', strtotime($tgl_keluar_lama.' + 1 year'));
            $data = array(
                'tgl_keluar' => $tgl_keluar_baru,
                'biaya'      => $biaya_baru
            );
            if ($this->m_data->update_penghuni($id, $data) == true){
                redirect (base_url('admin/pilih_kamar'));
                // echo $harga_kamar;
                // echo $biaya_lama;
                // echo $biaya_baru;
            }
            else {
                echo 'gagal gan :(';
            }
        }
    }

    function eks_penghuni($id = null){

        if (!isset($id)) redirect (base_url('admin/pilih_kamar'));

        $penghuni = $this->m_data->detail_penghuni(array('id' => $id))->row();

        if (!$penghuni){
            show_404();
        }
        else if ($this->m_data->update_penghuni($id, array('status' => 'Eks-Penghuni')) == true){

            $no_kamar = $penghuni->no_kamar;
            $kamar = $this->m_data->cek_kamar($no_kamar)->row();

            switch ($kamar->status){
                case 'sendiri':
                case 'terisi1':
                    $status_kamar = 'kosong';
                break;

                case 'terisi2':
                    $status_kamar = 'terisi1';
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $status_kamar);

            redirect (base_url('admin/pilih_kamar'));
            //echo 'berhasil perpanjang kamar';
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function aksi_hapus_pembayaran($id_pembayaran = null){

        if (!isset($id_pembayaran)) redirect (base_url('admin/riwayat_pembayaran'));

        $pembayaran = $this->m_data->detail_pembayaran(array('id_pembayaran' => $id_pembayaran))->row();

        if (!$pembayaran){
            show_404();
        }
        else if ($this->m_data->delete_pembayaran($id_pembayaran) == true){
            redirect (base_url('admin/riwayat_pembayaran'));
            //echo 'berhasil dihapus gan';
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function get_detail_penghuni(){
        $id_penghuni = $this->input->post('id_penghuni');
        $penghuni = $this->m_data->detail_penghuni(array('id' => $id_penghuni))->row();
        echo json_encode($penghuni);
    }

    function tambah_user(){
        $nama           = $this->input->post('nama');
        $username       = $this->input->post('username');
        $password       = sha1($this->input->post('password'));

        $user_baru = array(
            'nama'           => $nama,
            'username'       => $username,
            'password'       => $password
        );

        if ($this->m_data->insert_user($user_baru) == true){
            redirect (base_url('admin/tabel_user'));
        }
        else{
            $this->session->set_flashdata('pesan', 'gagal_tambah_user');
            redirect (base_url('admin/tambah_user'));
        }
    }

    function aksi_ubah_pass(){
        $username = $this->session->userdata('username');
        $password = $this->input->post('password');
        $password_baru = sha1($this->input->post('password_baru'));

        $this->load->model('m_login');
        $cek = $this->m_login->cek_login($username, $password);

        if ($cek->num_rows() > 0){
            if ($this->m_data->update_password($username, $password_baru) == true){
                //echo '<script>alert ("Password Berhasil Diubah, Silakan Login Kembali"); window.location="'.base_url('login/logout').'";</script>';
                $this->session->set_flashdata('pesan', 'berhasil_ubah_pass');
                redirect (base_url('login'));
            }
            else{
                echo 'Terjadi Kesalahan';
            }
        }
        else {
            $this->session->set_flashdata('pesan', 'gagal_ubah_pass');
            redirect (base_url('admin/ubah_pass'));
        }
    }

    function aksi_hapus_user($username = null){

        if (!isset($username)) redirect('admin/tabel_user');

        if ($this->m_data->delete_user($username) == true){
            redirect (base_url('admin/tabel_user'));
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function aksi_edit_pembayaran(){
        $id_penghuni = $this->input->post('id_penghuni');
        $nim = $this->input->post('nim');
        $no_kamar = $this->input->post('no_kamar');
        $biaya = $this->input->post('biaya');

        $id_pembayaran = $this->input->post('id_pembayaran');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $bayar = $this->input->post('bayar');
        $ket = $this->input->post('ket');

        $data_penghuni = array(
            'biaya' => $biaya
        );

        $data_pembayaran = array(
            'tgl_bayar' => $tgl_bayar,
            'bayar' => $bayar,
            'ket'   => $ket
        );

        if ($this->m_data->update_penghuni($id_penghuni, $data_penghuni) == true and $this->m_data->update_pembayaran($id_pembayaran, $data_pembayaran) == true){
            //echo 'berhasil diedit';
            redirect (base_url('admin/riwayat_pembayaran'));
        }
        else {
            echo 'gagal';
        }
    }
}

