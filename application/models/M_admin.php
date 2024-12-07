<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function get_poli()
    {
        $this->db->select('*');
        $this->db->from('tbl_poli');
        return $this->db->get()->result();
    }

    public function insert_poli($data)
    {
        $this->db->insert('tbl_poli', $data);
    }

    public function edit_poli($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_poli', $data);
    }
    public function delete_poli($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('tbl_poli', $data);
    }
}