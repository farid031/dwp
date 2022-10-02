
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_persetujuan extends CI_Controller
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
        $data['content'] = 'content/persetujuan';
        $data['title']     = 'Default';
        $data['penawaran'] = $this->M_data->getPersetujuan();
        
        $this->load->view('template/content', $data);
    }

    public function approve_penawaran()
    {
        $pen_id = $_POST['pen_id'];

        $penawaran = $this->db->get_where('penawaran_header', array('pen_id' => $pen_id))->row();

        $penUpd = array(
            'pen_is_approve'  => true,
            'pen_approved_by' => $_SESSION['id'],
            'pen_approved_at' => date('Y-m-d H:i:s')
        );

        $this->M_data->update_data('penawaran_header', $penUpd, 'pen_id = '.$pen_id);

        $arrCust = array(
            'cust_status' => 1,
            'cust_is_customer' => true
        );
        $this->M_data->update_data('customers', $arrCust, 'cust_id = ' . $penawaran->pen_cust_id);
    }

    public function reject_penawaran()
    {
        $pen_id = $_POST['pen_id'];

        $penawaran = $this->db->get_where('penawaran_header', array('pen_id' => $pen_id))->row();

        $penUpd = array(
            'pen_is_approve'  => false,
            'pen_approved_by' => $_SESSION['id'],
            'pen_approved_at' => date('Y-m-d H:i:s'),
            'pen_reject_note' => $_POST['alasan']
        );

        $this->M_data->update_data('penawaran_header', $penUpd, 'pen_id = ' . $pen_id);

        $arrCust = array(
            'cust_status' => 3
        );
        $this->M_data->update_data('customers', $arrCust, 'cust_id = ' . $penawaran->pen_cust_id);
    }
}
