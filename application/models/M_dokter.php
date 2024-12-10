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

    public function edit_profil($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_dokter', $data);
    }

    public function get_jadwal_periksa($id_dokter)
    {
        $this->db->select('tbl_jadwal_periksa.*, tbl_dokter.nama as nama_dokter');
        $this->db->from('tbl_jadwal_periksa');
        $this->db->where('tbl_jadwal_periksa.id_dokter', $id_dokter);

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

    public function get_daftar_poli_by_dokter($id_dokter)
    {
        $this->db->select('tbl_daftar_poli.id, tbl_daftar_poli.keluhan, tbl_daftar_poli.no_antrian, tbl_pasien.nama as nama_pasien, tbl_pasien.no_rm, tbl_periksa.tgl_periksa, tbl_periksa.catatan, tbl_periksa.biaya_periksa');
        $this->db->join('tbl_pasien', 'tbl_pasien.id = tbl_daftar_poli.id_pasien');
        $this->db->join('tbl_jadwal_periksa', 'tbl_jadwal_periksa.id = tbl_daftar_poli.id_jadwal');
        $this->db->join('tbl_dokter', 'tbl_dokter.id = tbl_jadwal_periksa.id_dokter');
        $this->db->join('tbl_poli', 'tbl_poli.id = tbl_dokter.id_poli');
        $this->db->join('tbl_periksa', 'tbl_periksa.id_daftar_poli = tbl_daftar_poli.id', 'left'); // Added LEFT JOIN
        $this->db->where('tbl_dokter.id', $id_dokter);
        $query = $this->db->get('tbl_daftar_poli');
        return $query->result();
    }

    public function get_periksa_by_daftar_poli($id_daftar_poli)
    {
        $this->db->select('id');
        $this->db->from('tbl_periksa');
        $this->db->where('id_daftar_poli', $id_daftar_poli);
        $query = $this->db->get();

        return $query->row();
    }
    public function insert_periksa($data_periksa, $obat_ids)
    {
        $this->db->insert('tbl_periksa', $data_periksa);
        $id_periksa = $this->db->insert_id();

        foreach ($obat_ids as $id_obat) {
            $data_detail_periksa = array(
                'id_periksa' => $id_periksa,
                'id_obat' => $id_obat
            );
            $this->db->insert('tbl_detail_periksa', $data_detail_periksa);
        }
    }

    public function edit_periksa($data_periksa, $obat_ids)
    {
        $this->db->where('id', $data_periksa['id']);
        $this->db->update('tbl_periksa', $data_periksa);
        $id_periksa = $data_periksa['id'];

        $this->db->where('id_periksa', $data_periksa['id']);
        $this->db->delete('tbl_detail_periksa');

        foreach ($obat_ids as $id_obat) {
            $data_detail_periksa = array(
                'id_periksa' => $id_periksa,
                'id_obat' => $id_obat
            );
            $this->db->insert('tbl_detail_periksa', $data_detail_periksa);
        }
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
}
