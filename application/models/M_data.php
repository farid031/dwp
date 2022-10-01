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
}
