<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pasien');
		$this->isLogin();
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

		$data = array(
			'menu' => 'Pasien',
			'title' => 'Poli',
			'detail_akun' => $this->M_pasien->get_akun($id_pasien),
			'isi' => 'pasien/v_poli_pasien'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'pasien') {
			redirect('auth/login_pasien');
		}
	}
}
