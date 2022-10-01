
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('M_data');
    }

    public function index()
    {
        //$data['content'] = 'content/login';
        $data['title']     = 'Login';

        $this->load->view('template/login', $data);
    }

    public function login()
    {
        $user = $this->input->post('user', TRUE);
        $pass = $this->input->post('pass', TRUE);

        $cek  = $this->db->get_where('users', ['user_username' => $user]);

        if ($cek->num_rows() > 0) {
            $hasil = $cek->row();
            if (password_verify($pass, $hasil->user_pass)) {
                // membuat session
                $userdata = array(
                    'id'        => $hasil->user_id,
                    'nama'      => $hasil->user_username,
                    'role'      => $hasil->user_role_id,
                    'is_login'  => TRUE,
                );

                $this->session->set_userdata($userdata);

                redirect(base_url('C_beranda'));
            } else {
                $this->session->set_flashdata('failed', 'Password is wrong...!');
                redirect(base_url('C_login'));
            }
        } else {
            $this->session->set_flashdata('failed', 'Username is invalid...!');
            redirect(base_url('C_login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('C_login'));
    }
}
