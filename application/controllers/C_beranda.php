
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_beranda extends CI_Controller
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
        $data['content'] = 'content/content';
        $data['title']     = 'Default';

        if ($_SESSION['id'] == 1) {
            $data['calon_cust'] = $this->M_data->getCountCalonCustAdmin()->row();
            $data['produk'] = $this->M_data->getCountProduk()->row();
            $data['penawaran'] = $this->M_data->getCountPenawaranAdmin()->row();
            $data['customer'] = $this->M_data->getCountCustAdmin()->row();
        } else {
            $data['calon_cust'] = $this->M_data->getCountCalonCustUser()->row();
            $data['produk'] = $this->M_data->getCountProduk()->row();
            $data['penawaran'] = $this->M_data->getCountPenawaranUser()->row();
            $data['customer'] = $this->M_data->getCountCustUser()->row();
        }

        $this->load->view('template/content', $data);
    }
}
