<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pasien extends CI_Model
{
    public function get_akun($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tbl_pasien');
        $this->db->where('id', $id_pasien);

        return $this->db->get()->row();
    }
}
