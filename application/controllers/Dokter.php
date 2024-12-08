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

	public function index()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		if (!$id_dokter) {
			redirect('auth/login_dokter');
		}
		$data = array(
			'title' => 'Dashboard',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'isi' => 'dokter/v_dashboard_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'dokter') {
			redirect('auth/login_dokter');
		}
	}
}
