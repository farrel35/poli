<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
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