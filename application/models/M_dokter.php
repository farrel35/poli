<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dokter extends CI_Model
{
    public function get_akun($id_dokter)
    {
        $this->db->select('*');
        $this->db->from('tbl_dokter');
        $this->db->where('id', $id_dokter);

        return $this->db->get()->row();
    }
}
