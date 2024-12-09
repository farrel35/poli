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
        $this->db->select('tbl_daftar_poli.id, tbl_daftar_poli.no_antrian, tbl_daftar_poli.keluhan, tbl_jadwal_periksa.hari, tbl_jadwal_periksa.jam_mulai, tbl_jadwal_periksa.jam_selesai, tbl_poli.nama_poli, tbl_dokter.nama AS nama_dokter');
        $this->db->from('tbl_daftar_poli');
        $this->db->join('tbl_jadwal_periksa', 'tbl_daftar_poli.id_jadwal = tbl_jadwal_periksa.id', 'left');
        $this->db->join('tbl_dokter', 'tbl_jadwal_periksa.id_dokter = tbl_dokter.id', 'left');
        $this->db->join('tbl_poli', 'tbl_dokter.id_poli = tbl_poli.id', 'left');
        $this->db->where('tbl_daftar_poli.id_pasien', $id_pasien);
        $query = $this->db->get();

        return $query->result();
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
