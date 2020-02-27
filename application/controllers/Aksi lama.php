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

        $status_awal_kamar = ($this->m_data->cek_kamar($no_kamar)->row())->status;

        if ($status_awal_kamar == 'sendiri' or $status_awal_kamar == 'terisi2'){
            echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';
        }
        else if ($this->m_data->insert_penghuni($data) == true){

            switch ($status_awal_kamar){
                case 'kosong':
                    $data_update_kamar = array(
                        'status'        => ($isi_kamar == '2') ? 'terisi1' : 'sendiri',
                        'status_bayar'  => ($piutang == 0) ? 'lunas' : 'piutang'
                    );
                    // $status_kamar = ($isi_kamar == '2') ? 'terisi1' : 'sendiri';
                    // $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
                break;

                case 'terisi1':
                    $penghuni_satunya = $this->m_data->data_penghuni(array('nim !=' => $nim, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'))->row();
                    //$penghuni_satunya = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar)->row();
                    $piutang_penghuni_satunya = $penghuni_satunya->biaya - $penghuni_satunya->bayar;

                    $data_update_kamar = array(
                        'status'        => 'terisi2',
                        'status_bayar'  => ($piutang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang'
                    );
                    // $status_kamar = 'terisi2';
                    // $status_bayar = ($piutang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang';
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $data_update_kamar);

            $id_penghuni = ($this->m_data->data_penghuni(array('nim' => $nim, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'))->row())->id;
            $data_pembayaran = array(
                'id_penghuni'   => $id_penghuni,
                //'nim'           => $nim,
                'tgl_bayar'     => $tgl_masuk,
                'bayar'         => $bayar
            );

            $this->m_data->insert_pembayaran($data_pembayaran);

            //redirect('admin/pilih_kamar');
            echo 'berhasil disimpan gan';
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
                //$biaya          = $this->input->post('biaya'); //belum dipakai
                //$piutang        = $this->input->post('piutang'); //belum dipakai

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

                    //redirect('admin/daftar_penghuni');
                    echo 'data berhasil diperbarui';
                }
                else {
                    echo 'gagal gan wokwokwok';
                }
            break;

            case "transaksi":
                $no_kamar = $this->input->post('no_kamar_lama');
                $tgl_bayar = $this->input->post('tgl_bayar');
                $bayar = $this->input->post('bayar');
                $data_pembayaran = array(
                    'id_penghuni'   => $id,
                    //'nim'           => $nim,
                    'tgl_bayar'     => $tgl_bayar,
                    'bayar'         => $bayar
                );

                if ($this->m_data->insert_pembayaran($data_pembayaran) == true){
                    $penghuni_sekarang = $this->m_data->data_penghuni(array('id' => $id))->row();
                    //$penghuni_sekarang = $this->m_data->data_keuangan_per_penghuni_by_nim_2($nim)->row();
                    $piutang_penghuni_sekarang = $penghuni_sekarang->biaya - $penghuni_sekarang->bayar;

                    $status_kamar = ($this->m_data->cek_kamar($no_kamar)->row())->status;

                    switch ($status_kamar){
                        case 'sendiri':
                        case 'terisi1':
                            $data_update_kamar = array(
                                'status_bayar' => ($piutang_penghuni_sekarang == 0) ? 'lunas' : 'piutang'
                            );
                            //$status_bayar = ($piutang_penghuni_sekarang == 0) ? 'lunas' : 'piutang';
                        break;

                        case 'terisi2':
                            $penghuni_satunya = $this->m_data->data_penghuni(array('id !=' => $id, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'))->row();
                            //$penghuni_satunya = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar)->row();
                            $piutang_penghuni_satunya = $penghuni_satunya->biaya - $penghuni_satunya->bayar;
                            $data_update_kamar = array(
                                'status_bayar' => ($piutang_penghuni_sekarang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang'
                            );
                            //$status_bayar = ($piutang_penghuni_sekarang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang';
                        break;
                    }
                    $this->m_data->update_status_kamar($no_kamar, $data_update_kamar);
                    //redirect('admin/daftar_penghuni');
                    echo 'transaksi sukses gayn';
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
                        $data_update_kamar_lama = array(
                            'status'        => 'kosong',
                            'status_bayar'  => 'lunas'
                        );
                        // $status_kamar_lama = 'kosong';
                        // $status_bayar_kamar_lama = 'lunas';
                    break;

                    case 'terisi2':
                        $penghuni_satunya_kamar_lama = $this->m_data->data_penghuni(array('id !=' => $id, 'no_kamar' => $no_kamar_lama, 'status' => 'Penghuni'))->row();
                        //$penghuni_satunya_kamar_lama = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar_lama)->row();
                        $piutang_penghuni_satunya_lama = $penghuni_satunya_kamar_lama->biaya - $penghuni_satunya_kamar_lama->bayar;

                        $data_update_kamar_lama = array(
                            'status'        => 'terisi1',
                            'status_bayar'  => ($piutang_penghuni_satunya_lama == 0) ? 'lunas' : 'piutang'
                        );
                        echo $penghuni_satunya_kamar_lama->nim;

                        // if (!$penghuni_kamar_lama){
                        //     $status_kamar_lama = 'kosong';
                        //     $status_bayar_kamar_lama = 'lunas';
                        // }
                        // else {
                        //     $piutang_penghuni_lain_lama = $penghuni_satunya_kamar_lama->biaya - $penghuni_satunya_kamar_lama->bayar;

                        //     $status_kamar_lama = 'terisi1';
                        //     $status_bayar_kamar_lama = ($piutang_penghuni_lain_lama == 0) ? 'lunas' : 'piutang';
                        // }
                    break;
                }

                $penghuni_sekarang = $this->m_data->data_penghuni(array('id' => $id))->row();
                //$penghuni_sekarang = $this->m_data->data_keuangan_per_penghuni_by_nim_2($nim)->row();
                $piutang = $penghuni_sekarang->biaya - $penghuni_sekarang->bayar;

                switch ($status_awal_kamar_baru){
                    case 'kosong':
                        $data_update_kamar_baru = array(
                            'status'        => ($penghuni_sekarang->isi_kamar == '2') ? 'terisi1' : 'sendiri',
                            'status_bayar'  => ($piutang == 0) ? 'lunas' : 'piutang'
                        );
                        //$status_kamar_baru = ($penghuni_sekarang->isi_kamar == '2') ? 'terisi1' : 'sendiri';
                        //$status_bayar_kamar_baru = ($piutang == 0) ? 'lunas' : 'piutang';
                        $isi_kamar = $penghuni_sekarang->isi_kamar;
                    break;

                    case 'terisi1':
                        $penghuni_satunya_kamar_baru = $this->m_data->data_penghuni(array('id !=' => $id, 'no_kamar' => $no_kamar_baru, 'status' => 'Penghuni'))->row();
                        //$cek_penghuni_kamar_baru = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar_baru)->row();
                        $piutang_penghuni_satunya_baru = $penghuni_satunya_kamar_baru->biaya - $penghuni_satunya_kamar_baru->bayar;
                        $data_update_kamar_baru = array(
                            'status'        => 'terisi2',
                            'status_bayar'  => ($piutang == 0 and $piutang_penghuni_satunya_baru == 0) ? 'lunas' : 'piutang'
                        );
                        //$status_kamar_baru = 'terisi2';
                        //$status_bayar_kamar_baru = ($piutang == 0 and $piutang_penghuni_lain_baru == 0) ? 'lunas' : 'piutang';
                        $isi_kamar = '2';
                    break;
                }
                $data_pindah_kamar = array(
                    'no_kamar' => $no_kamar_baru,
                    'isi_kamar' => $isi_kamar
                );

                $this->m_data->update_penghuni($id, $data_pindah_kamar);
                $this->m_data->update_status_kamar($no_kamar_lama, $data_update_kamar_lama);
                $this->m_data->update_status_kamar($no_kamar_baru, $data_update_kamar_baru);

                echo 'berhasil pindah kamar';
            break;

            default:
                echo "error gan :/";exit;
            break;
        }
    }

    function aksi_hapus_penghuni($id = null){

        if (!isset($id)) redirect('admin/daftar_penghuni');

        $penghuni = $this->m_data->data_penghuni(array('id' => $id))->row();

        if (!$penghuni){
            show_404();
        }
        else if ($this->m_data->delete_penghuni($id) == true){

            $no_kamar = $penghuni->no_kamar;
            $nim = $penghuni->nim;
            $kamar = $this->m_data->cek_kamar($no_kamar)->row();

            switch ($kamar->status){
                case 'sendiri':
                case 'terisi1':
                    $data_update_kamar = array(
                        'status'        => 'kosong',
                        'status_bayar'  => 'lunas'
                    );
                    // $status_kamar = 'kosong';
                    // $status_bayar = 'lunas';
                break;

                case 'terisi2':
                    $penghuni_satunya = $this->m_data->data_penghuni(array('id !=' => $id, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'))->row();
                    //$penghuni_satunya = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar)->row();
                    $piutang_penghuni_satunya = $penghuni_satunya->biaya - $penghuni_satunya->bayar;

                    $data_update_kamar = array(
                        'status'        => 'terisi1',
                        'status_bayar'  => ($piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang'
                    );
                    //$status_kamar = 'terisi1';

                    // if (!$cek_penghuni){
                    //     $status_bayar = 'lunas';
                    // }
                    // else {
                    //     $piutang = $cek_penghuni->biaya - $cek_penghuni->bayar;
                    //     $status_bayar = ($piutang == 0) ? 'lunas' : 'piutang';
                    // }
                break;
            }

            $this->m_data->update_status_kamar($no_kamar, $data_update_kamar);

            //redirect('admin/daftar_penghuni');
            echo 'berhasil dihapus gan';
        }
        else {
            echo 'gagal gan :(';
        }
    }

    function detail_penghuni(){
        $id_penghuni = $this->input->post('id_penghuni');
        $penghuni = $this->m_data->data_penghuni(array('id' => $id_penghuni))->row();
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
        //$tambah = $this->db->insert('admin', $user_baru); //pindah ke model
        //if(!$tambah) redirect (base_url('admin/tambah_user_gagal'));
        //else redirect (base_url(''));

        if ($this->m_data->insert_user($user_baru) == true){
            redirect (base_url('admin/daftar_user'));
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

    function aksi_hapus_user($username){
        //$username='null';
        //echo $username."kepanggil";exit;
        $this->m_data->delete_user($username);
        redirect (base_url('admin/daftar_user'));
    }

    function aksi_edit_pembayaran(){
        $id_penghuni = $this->input->post('id_penghuni');
        $nim = $this->input->post('nim');
        $no_kamar = $this->input->post('no_kamar');
        $biaya = $this->input->post('biaya');

        $id_pembayaran = $this->input->post('id_pembayaran');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $bayar = $this->input->post('bayar');

        $data_penghuni = array(
            'biaya' => $biaya
        );

        $data_pembayaran = array(
            'tgl_bayar' => $tgl_bayar,
            'bayar' => $bayar
        );

        if ($this->m_data->update_penghuni($id_penghuni, $data_penghuni) == true and $this->m_data->update_pembayaran($id_pembayaran, $data_pembayaran) == true){

            $status_kamar = ($this->m_data->cek_kamar($no_kamar)->row())->status;

            $penghuni_sekarang = $this->m_data->data_penghuni(array('id' => $id_penghuni))->row();
            //$penghuni_sekarang = $this->m_data->data_keuangan_per_penghuni_by_nim_2($nim)->row();
            $piutang_penghuni_sekarang = $penghuni_sekarang->biaya - $penghuni_sekarang->bayar;

            switch ($status_kamar){
                case 'sendiri':
                case 'terisi1':
                    $status_bayar = ($piutang_penghuni_sekarang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang';
                break;

                case 'terisi2':
                    $penghuni_satunya = $this->m_data->data_penghuni(array('id !=' => $id_penghuni, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'))->row();
                    //$penghuni_satunya = $this->m_data->data_keuangan_per_penghuni_by_nim($nim, $no_kamar)->row();
                    $piutang_penghuni_satunya = $penghuni_satunya->biaya - $penghuni_satunya->bayar;

                    $status_bayar  = ($piutang_penghuni_sekarang == 0 and $piutang_penghuni_satunya == 0) ? 'lunas' : 'piutang';
                break;
            }

            $data_update_kamar = array(
                'status'        => $status_kamar,
                'status_bayar'  => $status_bayar
            );

            $this->m_data->update_status_kamar($no_kamar, $data_update_kamar);

            echo 'berhasil diedit'; //belum menghitung piutang/lunas //sudah
        }
        else {
            echo 'gagal';
        }
    }
}

