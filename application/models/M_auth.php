<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function generate_no_rm()
    {
        $year_month = date('Ym');
        $this->db->like('no_rm', $year_month, 'after');
        $this->db->from('tbl_pasien');
        $count = $this->db->count_all_results();
        $no_rm = $year_month . '-' . str_pad(($count + 1), 3, '0', STR_PAD_LEFT);

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

    public function login_dokter($nama, $alamat)
    {
        $this->db->where('nama', $nama);
        $this->db->where('alamat', $alamat);
        $query = $this->db->get('tbl_dokter');

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
}
