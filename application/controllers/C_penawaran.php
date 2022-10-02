
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_penawaran extends CI_Controller
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
        $data['content'] = 'content/penawaran';
        $data['title']     = 'Default';
        if ($_SESSION['role'] == 1) {
            $data['penawaran'] = $this->M_data->getPenawaranByAdmin();
        } else {
            $data['penawaran'] = $this->M_data->getPenawaranByUser($_SESSION['id']);
        }
        
        $this->load->view('template/content', $data);
    }
}
