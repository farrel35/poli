<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pasien extends CI_Model
{
    public function generate_no_rm()
    {
        $year_month = date('Ym');
        $this->db->like('no_rm', $year_month, 'after');
        $this->db->from('tbl_pasien');
        $count = $this->db->count_all_results();
        $no_rm = $year_month . '-' . ($count + 1);

        return $no_rm;
    }

    public function insert_pasien($data)
    {
        $this->db->insert('tbl_pasien', $data);
    }

    public function login_pasien($nama, $alamat)
    {
        $this->db->where('nama', $nama);
        $this->db->where('alamat', $alamat);
        $query = $this->db->get('tbl_pasien');

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
}