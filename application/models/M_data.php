<?php
class M_data extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_data($table)
    {
        $db = $this->load->database('default', true);
        return $db->get($table);
    }
    function get_data_where($table, $where)
    {
        $db = $this->load->database('default', true);
        return $db->get_where($table, $where);
    }
    function simpan_data($table, $data)
    {
        $db = $this->load->database('default', true);
        $db->insert($table, $data);
    }
    function update_data($table, $data, $where)
    {
        $db = $this->load->database('default', true);
        $db->update($table, $data, $where);
    }
    function hapus_data($table, $where)
    {
        $db = $this->load->database('default', true);
        $db->delete($table, $where);
    }
    function kosong_data($table)
    {
        $db = $this->load->database('default', true);
        $db->truncate($table);
    }

    public function getLeadByAdmin()
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                customers
                LEFT JOIN customer_status ON cust_status = stat_cust_id
            WHERE
                cust_is_customer IS NOT TRUE"
        );

        return $query;
    }

    public function getLeadByUser($id_user)
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                customers
                LEFT JOIN customer_status ON cust_status = stat_cust_id
            WHERE
                cust_is_customer IS NOT TRUE
                AND cust_created_by = ".$id_user
        );

        return $query;
    }

    public function getProdukByAdmin()
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                produk"
        );

        return $query;
    }

    public function getProdukByUser($id_user)
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                customers
            WHERE
                AND produk_created_by = ".$id_user
        );

        return $query;
    }

    public function getLeadPenawaranByAdmin()
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                customers
                LEFT JOIN customer_status ON cust_status = stat_cust_id
            WHERE
                cust_is_customer IS NOT TRUE
                AND cust_status = 4"
        );

        return $query;
    }

    public function getLeadPenawaranByUser($id_user)
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                customers
                LEFT JOIN customer_status ON cust_status = stat_cust_id
            WHERE
                cust_is_customer IS NOT TRUE
                AND cust_status = 4
                AND cust_created_by = " . $id_user
        );

        return $query;
    }

    public function getProdukPenawaran($cust_id)
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                produk"
        );

        return $query;
    }

    public function getProdukPenawaranCust($cust_id)
    {
        $query = $this->db->query(
            "SELECT
                * 
            FROM
                penawaran_header
                INNER JOIN penawaran_detail AS det ON pen_id = det.pen_det_id_head
                LEFT JOIN produk ON produk_id = det.pen_det_produk_id 
            WHERE
                pen_cust_id = ".$cust_id
        );

        return $query;
    }

    public function getPenawaranHeader($cust_id)
    {
        $query = $this->db->query(
            "SELECT
                * 
            FROM
                penawaran_header
            WHERE
                pen_cust_id = " . $cust_id
        );

        return $query;
    }

    public function nextId($id_field)
    {
        $query = $this->db->query(
            "SELECT ".$id_field." AS id"
        );

        return $query->row();
    }

    public function getPenawaranByAdmin()
    {
        $query = $this->db->query(
            "SELECT
                pen_id,
                cust_id,
                cust_name,
                cust_alamat,
                (SELECT COUNT(*) FROM penawaran_detail WHERE pen_det_id_head = pen_id) AS jml_produk,
                (CASE 
                    WHEN pen_is_approve IS TRUE THEN 'Disetujui<br/>Oleh '||user_username||' pada '||TO_CHAR(pen_approved_at, 'DD Mon YYYY HH24:MI:SS')
                    WHEN pen_is_approve IS FALSE THEN 'Ditolak<br/>Oleh '||user_username||' pada '||TO_CHAR(pen_approved_at, 'DD Mon YYYY HH24:MI:SS')||'<br/>Alasan tolak: '||pen_reject_note
                    ELSE 'Menunggu Persetujuan'
                END) AS status
            FROM
                penawaran_header
                INNER JOIN customers ON cust_id = pen_cust_id
                LEFT JOIN users ON user_id = pen_approved_by"
        );

        return $query;
    }

    public function getPenawaranByUser($user_id)
    {
        $query = $this->db->query(
            "SELECT
                pen_id,
                cust_id,
                cust_name,
                cust_alamat,
                (SELECT COUNT(*) FROM penawaran_detail WHERE pen_det_id_head = pen_id) AS jml_produk,
                (CASE 
                    WHEN pen_is_approve IS TRUE THEN 'Disetujui<br/>Oleh '||user_username||' pada '||TO_CHAR(pen_approved_at, 'DD Mon YYYY HH24:MI:SS')
                    WHEN pen_is_approve IS FALSE THEN 'Ditolak<br/>Oleh '||user_username||' pada '||TO_CHAR(pen_approved_at, 'DD Mon YYYY HH24:MI:SS')||'<br/>Alasan tolak: '||pen_reject_note
                    ELSE 'Menunggu Persetujuan'
                END) AS status
            FROM
                penawaran_header
                INNER JOIN customers ON cust_id = pen_cust_id
                LEFT JOIN users ON user_id = pen_approved_by
            WHERE
                pen_created_by = ".$user_id
        );

        return $query;
    }
}
