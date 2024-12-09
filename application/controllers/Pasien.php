<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pasien');
		$this->load->model('M_admin');
		$this->isLogin();
	}

	private function set_validation_rules($type)
	{
		$rules = [
			'daftar_poli' => [
				['field' => 'id_jadwal', 'label' => 'Jadwal', 'rules' => 'required'],
				['field' => 'keluhan', 'label' => 'Keluhan', 'rules' => 'required'],
			]
		];

		if (isset($rules[$type])) {
			$this->form_validation->set_rules($rules[$type]);
		}
	}

	public function index()
	{
		$id_pasien = $this->session->userdata('id_pasien');

		$data = array(
			'menu' => 'Pasien',
			'title' => 'Dashboard',
			'detail_akun' => $this->M_pasien->get_akun($id_pasien),
			'isi' => 'pasien/v_dashboard_pasien'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function poli()
	{
		$id_pasien = $this->session->userdata('id_pasien');

		$riwayat_poli = $this->M_pasien->get_riwayat_poli($id_pasien);

		foreach ($riwayat_poli as &$item) {
			$item->periksa_exists = $this->M_pasien->get_periksa_by_daftar_poli($item->id);
		}
		var_dump($riwayat_poli);
		exit;
		$data = array(
			'menu' => 'Pasien',
			'title' => 'Poli',
			'detail_akun' => $this->M_pasien->get_akun($id_pasien),
			'riwayat_poli' => $riwayat_poli,
			'poli' => $this->M_admin->get_poli(),
			'isi' => 'pasien/v_poli_pasien'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function get_jadwal_by_poli($id_poli)
	{
		$jadwal = $this->M_pasien->get_jadwal_by_poli($id_poli);
		echo json_encode($jadwal);
	}

	public function daftar_poli()
	{
		$this->set_validation_rules('daftar_poli');

		$id_pasien = $this->session->userdata('id_pasien');
		if ($this->form_validation->run() === FALSE) {

			$data = array(
				'menu' => 'Pasien',
				'title' => 'Poli',
				'detail_akun' => $this->M_pasien->get_akun($id_pasien),
				'riwayat_poli' => $this->M_pasien->get_riwayat_poli($id_pasien),
				'poli' => $this->M_admin->get_poli(),
				'isi' => 'pasien/v_poli_pasien'
			);
			$this->session->set_flashdata('error', 'Gagal mendaftar poli. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$id_jadwal = $this->input->post('id_jadwal');
			$keluhan = $this->input->post('keluhan');

			$current_antrian = $this->M_pasien->get_max_antrian_by_jadwal($id_jadwal);
			$no_antrian = $current_antrian ? $current_antrian + 1 : 1;

			$data = [
				'id_pasien' => $id_pasien,
				'id_jadwal' => $id_jadwal,
				'keluhan' => $keluhan,
				'no_antrian' => $no_antrian
			];

			$this->M_pasien->daftar_poli($data);
			$this->session->set_flashdata('success', 'Daftar poli berhasil.');
			redirect('pasien/poli');
		}
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'pasien') {
			redirect('auth/login_pasien');
		}
	}
}
