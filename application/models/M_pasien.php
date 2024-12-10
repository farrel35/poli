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

    public function get_jadwal_by_poli($id_poli)
    {
        $this->db->select('tbl_jadwal_periksa.id, tbl_jadwal_periksa.hari, tbl_jadwal_periksa.jam_mulai, tbl_jadwal_periksa.jam_selesai, tbl_dokter.nama');
        $this->db->join('tbl_dokter', 'tbl_dokter.id = tbl_jadwal_periksa.id_dokter');
        $this->db->where('tbl_dokter.id_poli', $id_poli);
        $this->db->where('tbl_jadwal_periksa.isActive', 1);
        $query = $this->db->get('tbl_jadwal_periksa');
        return $query->result();
    }

    public function get_riwayat_poli($id_pasien)
    {
        $this->db->select('
            tbl_daftar_poli.id, 
            tbl_daftar_poli.no_antrian, 
            tbl_daftar_poli.keluhan, 
            tbl_jadwal_periksa.hari, 
            tbl_jadwal_periksa.jam_mulai, 
            tbl_jadwal_periksa.jam_selesai, 
            tbl_poli.nama_poli, 
            tbl_dokter.nama AS nama_dokter,
            tbl_periksa.id AS periksa_id,
            tbl_periksa.tgl_periksa,
            tbl_periksa.catatan,
            tbl_periksa.biaya_periksa
        ');
        $this->db->from('tbl_daftar_poli');
        $this->db->join('tbl_jadwal_periksa', 'tbl_daftar_poli.id_jadwal = tbl_jadwal_periksa.id', 'left');
        $this->db->join('tbl_dokter', 'tbl_jadwal_periksa.id_dokter = tbl_dokter.id', 'left');
        $this->db->join('tbl_poli', 'tbl_dokter.id_poli = tbl_poli.id', 'left');
        $this->db->join('tbl_periksa', 'tbl_daftar_poli.id = tbl_periksa.id_daftar_poli', 'left'); // Join tbl_periksa
        $this->db->where('tbl_daftar_poli.id_pasien', $id_pasien);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_detail_periksa($id_periksa)
    {
        $this->db->select('
            tbl_periksa.id AS periksa_id,
            tbl_periksa.tgl_periksa,
            tbl_periksa.catatan,
            tbl_periksa.biaya_periksa,
            tbl_detail_periksa.id AS detail_periksa_id,
            tbl_detail_periksa.id_obat,
            tbl_obat.nama_obat AS nama_obat,
            tbl_obat.harga AS harga_obat
        ');
        $this->db->from('tbl_detail_periksa');
        $this->db->join('tbl_periksa', 'tbl_periksa.id = tbl_detail_periksa.id_periksa', 'left');
        $this->db->join('tbl_obat', 'tbl_detail_periksa.id_obat = tbl_obat.id', 'left');
        $this->db->where('tbl_detail_periksa.id_periksa', $id_periksa);
        $query = $this->db->get();

        return $query->result();
    }


    public function get_periksa_by_daftar_poli($id_daftar_poli)
    {
        $this->db->select('id');
        $this->db->from('tbl_periksa');
        $this->db->where('id_daftar_poli', $id_daftar_poli);
        $query = $this->db->get();

        // Check if the result exists, and return only the id, or null if not found
        $result = $query->row();
        return $result ? $result->id : null; // Return only the id or null if not found
    }
    public function get_max_antrian_by_jadwal($id_jadwal)
    {
        $this->db->select_max('no_antrian');
        $this->db->where('id_jadwal', $id_jadwal);
        $query = $this->db->get('tbl_daftar_poli');
        return $query->row()->no_antrian;
    }

    public function daftar_poli($data)
    {
        $this->db->insert('tbl_daftar_poli', $data);
    }
}
