
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
            $this->session->set_flashdata('failed', 'Anda belum login, harap login terlebih dahulu...');
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
            'cust_created_by'   => $_SESSION['id'],
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
            'cust_updated_by'   => $_SESSION['id'],
            'cust_updated_at'   => date('Y-m-d H:i:s')
        );

        $this->M_data->update_data('customers', $dataLead, 'cust_id = '. $cust_id);
        redirect('C_lead');
    }

    public function hapus_lead()
    {
        $id_lead = $_POST['id_lead'];

        $pen_head = $this->db->get_where('penawaran_header', array('pen_cust_id' => $id_lead))->row();

        $this->M_data->hapus_data('penawaran_detail', 'pen_det_id_head = ' . $pen_head->pen_id);
        $this->M_data->hapus_data('penawaran_header', 'pen_cust_id = ' . $id_lead);
        $this->M_data->hapus_data('customers', 'cust_id = ' . $id_lead);
    }

    public function form_penawaran($cust_id)
    {
        $data['content']    = 'content/form_penawaran';
        $data['title']      = 'Default';
        $data['produk']     = $this->M_data->getProdukPenawaran($cust_id);
        $data['produk_ditawarkan'] = $this->M_data->getProdukPenawaranCust($cust_id);
        $data['lead']       = $this->db->get_where('customers', array('cust_id' => $cust_id))->row();

        $this->load->view('template/content', $data);
    }

    public function simpan_penawaran($cust_id)
    {
        $post = $this->input->post();
        $produk_id = $post['produk_penawaran'];
        $hrg_ditawar = $post['harga_ditawar'];

        $pen_header = $this->M_data->getPenawaranHeader($cust_id)->row();
        
        if (!empty($pen_header)) {
            $pen_det = array(
                'pen_det_id_head' => $pen_header->pen_id,
                'pen_det_produk_id' => $produk_id,
                'pen_det_harga' => $hrg_ditawar
            );

            $this->M_data->simpan_data('penawaran_detail', $pen_det);

            $this->M_data->update_data('customers', array('cust_status' => 2), 'cust_id = ' . $cust_id);
        } else {
            $pen_head = array(
                'pen_cust_id'    => $cust_id,
                'pen_created_by' => $_SESSION['id'],
                'pen_created_at' => date('Y-m-d H:i:s')
            );
            $this->M_data->simpan_data('penawaran_header', $pen_head);

            $this->M_data->update_data('customers', array('cust_status' => 2), 'cust_id = ' . $cust_id);

            $data_pen_head = $this->db->get_where('penawaran_header', array('pen_cust_id' => $cust_id))->row();

            $pen_det = array(
                'pen_det_id_head'   => $data_pen_head->pen_id,
                'pen_det_produk_id' => $produk_id,
                'pen_det_harga'     => $hrg_ditawar
            );
            $this->M_data->simpan_data('penawaran_detail', $pen_det);
        }

        redirect(base_url('C_lead/form_penawaran/'.$cust_id), 'refresh');
    }

    public function hapus_produk_penawaran()
    {
        $det_id = $_POST['produk_det_id'];

        $this->M_data->hapus_data('penawaran_detail', 'pen_det_id = ' . $det_id);
    }

    public function get_harga_produk()
    {
        $produk_id = $_POST['produk_id'];

        $produk = $this->db->get_where('produk', array('produk_id' => $produk_id))->row();

        $arrReturn = array(
            'harga' => $produk->produk_harga
        );
        
        die(json_encode($arrReturn));
    }
}
