
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        //$data['gunung'] = $this->M_data->get_data('tbl_gunung');

        $this->load->view('template/content', $data);
    }
}
