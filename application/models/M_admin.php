<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function get_dokter_count()
    {
        $this->db->from('tbl_poli');
        return $this->db->count_all_results();
    }

    public function get_pasien_count()
    {
        $this->db->from('tbl_pasien');
        return $this->db->count_all_results();
    }
    public function get_poli_count()
    {
        $this->db->from('tbl_poli');
        return $this->db->count_all_results();
    }
    public function get_obat_count()
    {
        $this->db->from('tbl_obat');
        return $this->db->count_all_results();
    }

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

    public function get_dokter()
    {
        $this->db->select('tbl_dokter.id, tbl_dokter.nama, tbl_dokter.alamat, tbl_dokter.no_hp, tbl_dokter.id_poli, tbl_poli.nama_poli');
        $this->db->from('tbl_dokter');
        $this->db->join('tbl_poli', 'tbl_dokter.id_poli = tbl_poli.id', 'left');

        return $this->db->get()->result();
    }

    public function insert_dokter($data)
    {
        $this->db->insert('tbl_dokter', $data);
    }

    public function edit_dokter($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_dokter', $data);
    }
    public function delete_dokter($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('tbl_dokter', $data);
    }

    public function get_obat()
    {
        $this->db->select('*');
        $this->db->from('tbl_obat');
        return $this->db->get()->result();
    }

    public function insert_obat($data)
    {
        $this->db->insert('tbl_obat', $data);
    }

    public function edit_obat($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_obat', $data);
    }
    public function delete_obat($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('tbl_obat', $data);
    }

    public function get_pasien()
    {
        $this->db->select('*');
        $this->db->from('tbl_pasien');
        return $this->db->get()->result();
    }

    public function insert_pasien($data)
    {
        $this->db->insert('tbl_pasien', $data);
    }

    public function edit_pasien($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_pasien', $data);
    }
    public function delete_pasien($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('tbl_pasien', $data);
    }
}