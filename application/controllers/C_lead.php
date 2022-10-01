
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_lead extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        if (!empty($this->session->userdata('is_login') == FALSE)) {
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed', 'You are not login yet, please login first...');
            redirect(base_url('C_login'));
        }
    }

    public function index()
    {
        $data['content'] = 'content/lead';
        $data['title']     = 'Default';
        if ($_SESSION['role'] == 1) {
            $data['lead'] = $this->M_data->getLeadByAdmin();
        } else {
            $data['lead'] = $this->M_data->getLeadByUser($_SESSION['id']);
        }
        
        $this->load->view('template/content', $data);
    }

    public function tambah_lead()
    {
        $post = $this->input->post();

        $nama_perusahaan    = $post['nama_lead'];
        $alamat             = $post['alamat_lead'];
        $nama_pic           = $post['nama_pic'];
        $no_telp_pic        = $post['no_telp_pic'];

        $dataLead = array(
            'cust_name'         => $nama_perusahaan,
            'cust_alamat'       => $alamat,
            'cust_pic_name'     => $nama_pic,
            'cust_pic_telp'     => $no_telp_pic,
            'cust_is_customer'  => false,
            'cust_status'       => 4,
            'cust_created_by'   => $_SERVER['id'],
            'cust_created_at'   => date('Y-m-d H:i:s')
        );

        $this->M_data->simpan_data('customers', $dataLead);
        redirect('C_lead');
    }

    public function ubah_lead($cust_id)
    {
        $post = $this->input->post();

        $nama_perusahaan    = $post['nama_lead'];
        $alamat             = $post['alamat_lead'];
        $nama_pic           = $post['nama_pic'];
        $no_telp_pic        = $post['no_telp_pic'];

        $dataLead = array(
            'cust_name'         => $nama_perusahaan,
            'cust_alamat'       => $alamat,
            'cust_pic_name'     => $nama_pic,
            'cust_pic_telp'     => $no_telp_pic,
            'cust_is_customer'  => false,
            'cust_status'       => 4,
            'cust_created_by'   => $_SERVER['id'],
            'cust_created_at'   => date('Y-m-d H:i:s')
        );

        $this->M_data->update_data('customers', $dataLead, 'cust_id = '. $cust_id);
        redirect('C_lead');
    }

    public function hapus_lead()
    {
        $id_lead = $_POST['id_lead'];

        $this->M_data->hapus_data('customers', 'cust_id = ' . $id_lead);
    }
}
