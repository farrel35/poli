<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'isi' => 'admin/v_dashboard_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function dokter()
	{
		$data = array(
			'title' => 'Dokter',
			'dokter' => $this->M_admin->get_dokter(),
			'poli' => $this->M_admin->get_poli(),
			'isi' => 'admin/v_dokter_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}
	public function poli()
	{
		$data = array(
			'title' => 'Poli',
			'poli' => $this->M_admin->get_poli(),
			'isi' => 'admin/v_poli_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function tambah_poli()
	{
		$this->form_validation->set_rules('nama_poli', 'Nama Poli', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[5]');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'title' => 'Poli',
				'poli' => $this->M_admin->get_poli(),
				'isi' => 'admin/v_poli_admin'
			);
			$this->session->set_flashdata('error', 'Gagal menambah poli. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$nama_poli = $this->input->post('nama_poli');
			$keterangan = $this->input->post('keterangan');

			$this->db->where('nama_poli', $nama_poli);
			$existing_poli = $this->db->get('tbl_poli')->row();

			if ($existing_poli) {
				$this->session->set_flashdata('error', 'Poli tersebut sudah terdaftar.');
				redirect('admin/poli');
			} else {
				$data = [
					'nama_poli' => $nama_poli,
					'keterangan' => $keterangan
				];

				$this->M_admin->insert_poli($data);
				$this->session->set_flashdata('success', 'Poli berhasil ditambahkan.');
				redirect('admin/poli');
			}
		}
	}

	public function edit_poli($id = NULL)
	{
		$data = array(
			'id' => $id,
			'nama_poli' => $this->input->post('nama_poli'),
			'keterangan' => $this->input->post('keterangan')
		);
		$this->M_admin->edit_poli($data);
		$this->session->set_flashdata('success', 'Poli berhasil diedit');
		redirect('admin/poli');
	}

	public function delete_poli($id = NULL)
	{
		$data = array('id' => $id);
		$this->M_admin->delete_poli($data);
		$this->session->set_flashdata('success', 'Poli berhasil dihapus');
		redirect('admin/poli');
	}

	public function tambah_dokter()
	{
		$this->form_validation->set_rules('nama', 'Nama Dokter', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('id_poli', 'Poli', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'title' => 'Dokter',
				'dokter' => $this->M_admin->get_dokter(),
				'poli' => $this->M_admin->get_poli(),
				'isi' => 'admin/v_dokter_admin'
			);
			$this->session->set_flashdata('error', 'Gagal menambah dokter. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$no_hp = $this->input->post('no_hp');
			$id_poli = $this->input->post('id_poli');

			$this->db->where('nama', $nama);
			$existing_dokter = $this->db->get('tbl_dokter')->row();

			if ($existing_dokter) {
				$this->session->set_flashdata('error', 'Dokter tersebut sudah terdaftar.');
				redirect('admin/dokter');
			} else {
				$data = [
					'nama' => $nama,
					'alamat' => $alamat,
					'no_hp' => $no_hp,
					'id_poli' => $id_poli
				];

				$this->M_admin->insert_dokter($data);
				$this->session->set_flashdata('success', 'Dokter berhasil ditambahkan.');
				redirect('admin/dokter');
			}
		}
	}

	public function edit_dokter($id = NULL)
	{
		$data = array(
			'id' => $id,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'id_poli' => $this->input->post('id_poli')
		);
		$this->M_admin->edit_dokter($data);
		$this->session->set_flashdata('success', 'Dokter berhasil diedit');
		redirect('admin/dokter');
	}

	public function delete_dokter($id = NULL)
	{
		$data = array('id' => $id);
		$this->M_admin->delete_dokter($data);
		$this->session->set_flashdata('success', 'Dokter berhasil dihapus');
		redirect('admin/dokter');
	}
}