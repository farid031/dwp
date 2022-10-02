
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        if (!empty($this->session->userdata('is_login') == FALSE)) {
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed', 'Anda belum login, harap login terlebih dahulu...');
            redirect(base_url('C_login'));
        }
    }

    public function index()
    {
        $data['content'] = 'content/produk';
        $data['title']     = 'Default';
        if ($_SESSION['role'] == 1) {
            $data['produk'] = $this->M_data->getProdukByAdmin();
        } else {
            $data['produk'] = $this->M_data->getProdukByUser($_SESSION['id']);
        }
        
        $this->load->view('template/content', $data);
    }

    public function tambah_produk()
    {
        $post = $this->input->post();

        $nama    = $post['nama_produk'];
        $harga   = $post['harga_produk'];

        $dataProduk = array(
            'produk_label'      => $nama,
            'produk_harga'      => $harga,
            'produk_created_by' => $_SESSION['id'],
            'produk_created_at' => date('Y-m-d H:i:s')
        );

        $this->M_data->simpan_data('produk', $dataProduk);
        redirect('C_produk');
    }

    public function ubah_produk($produk_id)
    {
        $post = $this->input->post();

        $nama    = $post['nama_produk'];
        $harga   = $post['harga_produk'];

        $dataProduk = array(
            'produk_label'      => $nama,
            'produk_harga'      => $harga,
            'produk_updated_by' => $_SESSION['id'],
            'produk_updated_at' => date('Y-m-d H:i:s')
        );

        $this->M_data->update_data('produk', $dataProduk, 'produk_id = '. $produk_id);
        redirect('C_produk');
    }

    public function hapus_produk()
    {
        $produk_id = $_POST['produk_id'];

        $this->M_data->hapus_data('produk', 'produk_id = ' . $produk_id);
    }
}
