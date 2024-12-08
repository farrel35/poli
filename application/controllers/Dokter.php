<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dokter');
		$this->isLogin();
	}

	private function set_validation_rules($type)
	{
		$rules = [
			'tambah_jadwal_periksa' => [
				['field' => 'hari', 'label' => 'Hari', 'rules' => 'required'],
				['field' => 'jam_mulai', 'label' => 'Jam Mulai', 'rules' => 'required'],
				['field' => 'jam_selesai', 'label' => 'Jam Selesai', 'rules' => 'required']
			]
		];

		if (isset($rules[$type])) {
			$this->form_validation->set_rules($rules[$type]);
		}
	}
	public function index()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$data = array(
			'menu' => 'Dokter',
			'title' => 'Dashboard',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'isi' => 'dokter/v_dashboard_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function jadwal_periksa()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$data = array(
			'menu' => 'Dokter',
			'title' => 'Jadwal Periksa',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'jadwal_periksa' => $this->M_dokter->get_jadwal_periksa(),
			'isi' => 'dokter/v_jadwal_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function tambah_jadwal_periksa()
	{
		$this->set_validation_rules('tambah_jadwal_periksa');

		$id_dokter = $this->session->userdata('id_dokter');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'menu' => 'Dokter',
				'title' => 'Jadwal Periksa',
				'detail_akun' => $this->M_dokter->get_akun($id_dokter),
				'jadwal_periksa' => $this->M_dokter->get_jadwal_periksa(),
				'isi' => 'dokter/v_jadwal_dokter'
			);
			$this->session->set_flashdata('error', 'Gagal menambah pasien. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$hari = $this->input->post('hari');
			$jam_mulai = $this->input->post('jam_mulai');
			$jam_selesai = $this->input->post('jam_selesai');

			$this->db->where('hari', $hari);
			$existing_hari = $this->db->get('tbl_jadwal_periksa')->row();

			if ($existing_hari) {
				$this->session->set_flashdata('error', 'Jadwal tersebut sudah terdaftar.');
				redirect('dokter/jadwal_periksa');
			} else {
				$data = [
					'id_dokter' => $id_dokter,
					'hari' => $hari,
					'jam_mulai' => $jam_mulai,
					'jam_selesai' => $jam_selesai
				];

				$this->M_dokter->insert_jadwal_periksa($data);
				$this->session->set_flashdata('success', 'Jadwal berhasil ditambahkan.');
				redirect('dokter/jadwal_periksa');
			}
		}
	}

	public function edit_jadwal_periksa($id = NULL)
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$data = array(
			'id' => $id,
			'id_dokter' => $id_dokter,
			'isActive' => $this->input->post('isActive')
		);
		$this->M_dokter->edit_jadwal_periksa($data);
		$this->session->set_flashdata('success', 'Jadwal berhasil diedit');
		redirect('dokter/jadwal_periksa');
	}

	public function delete_jadwal_periksa($id = NULL)
	{
		$data = array('id' => $id);
		$this->M_dokter->delete_jadwal_periksa($data);
		$this->session->set_flashdata('success', 'Jadwal berhasil dihapus');
		redirect('dokter/jadwal_periksa');
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'dokter') {
			redirect('auth/login_dokter');
		}
	}
}