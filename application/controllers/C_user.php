
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_user extends CI_Controller
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
        $data['content'] = 'content/user';
        $data['title']     = 'Default';
        $data['user'] = $this->M_data->getUser();
        $data['role'] = $this->M_data->getUserRole();
        
        $this->load->view('template/content', $data);
    }

    public function tambah_user()
    {
        $username   = $_POST['username'];
        $role       = $_POST['role'];
        $pass       = $_POST['pass'];
        $repass     = $_POST['repass'];

        $dataUser = array(
            'user_username'   => $username,
            'user_role_id'    => $role,
            'user_created_by' => $_SESSION['id'],
            'user_created_at' => date('Y-m-d H:i:s')
        );

        if (!empty($pass) && !empty($repass)) {
            if ($pass === $repass) {
                $dataUser['user_pass'] = password_hash($pass, PASSWORD_DEFAULT);

                $this->M_data->simpan_data('users', $dataUser);

                echo 'sukses';
            } else {
                echo 'ERROR: Password yang Anda masukkan tidak sama';
            }
        }
    }

    public function ubah_user()
    {
        $username   = $_POST['username'];
        $role       = $_POST['role'];
        $pass       = $_POST['pass'];
        $repass     = $_POST['repass'];
        $user_id    = $_POST['user_id'];

        $dataUser = array(
            'user_username'   => $username,
            'user_role_id'    => $role,
            'user_updated_by' => $_SESSION['id'],
            'user_updated_at' => date('Y-m-d H:i:s')
        );

        if (!empty($pass) && !empty($repass)) {
            if ($pass === $repass) {
                $dataUser['user_pass'] = password_hash($pass, PASSWORD_DEFAULT);
            } else {
                echo 'ERROR: Password yang Anda masukkan tidak sama';
            }
        }

        $this->M_data->update_data('users', $dataUser, 'user_id = ' . $user_id);

        echo 'sukses';
    }

    public function hapus_user()
    {
        $user_id = $_POST['user_id'];

        $this->M_data->hapus_data('users', 'user_id = ' . $user_id);
    }
}
