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

    public function get_jadwal_periksa()
    {
        $this->db->select('tbl_jadwal_periksa.*, tbl_dokter.nama as nama_dokter');
        $this->db->from('tbl_jadwal_periksa');

        $this->db->join('tbl_dokter', 'tbl_dokter.id = tbl_jadwal_periksa.id_dokter');

        return $this->db->get()->result();
    }


    public function insert_jadwal_periksa($data)
    {
        $this->db->insert('tbl_jadwal_periksa', $data);
    }

    public function edit_jadwal_periksa($data)
    {
        $this->db->where('id_dokter', $data['id_dokter']);
        $this->db->update('tbl_jadwal_periksa', ['isActive' => 0]);

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_jadwal_periksa', $data);
    }

    public function delete_jadwal_periksa($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('tbl_jadwal_periksa', $data);
    }
}