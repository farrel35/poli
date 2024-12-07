<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dokter extends CI_Model
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

    public function get_akun($id_pasien)
    {
        $this->db->select('*');
        $this->db->from('tbl_pasien');
        $this->db->where('id', $id_pasien);

        return $this->db->get()->row();
    }
}