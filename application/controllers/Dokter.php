<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dokter');
	}

	public function index()
	{
		$id_pasien = $this->session->userdata('id_pasien');

		if (!$id_pasien) {
			redirect('pasien/login_pasien');
		}
		$data = array(
			'title' => 'Dashboard',
			'detail_akun' => $this->M_pasien->get_akun($id_pasien),
			'isi' => 'pasien/v_dashboard_pasien'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function login()
	{
		$this->load->view('dokter/v_login_dokter', FALSE);
	}

	public function login_dokter()
	{
		$this->form_validation->set_rules('nama', 'Fullname', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dokter/v_login_dokter');
		} else {
			$fullname = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			if ($fullname === 'admin' && $alamat === 'admin') {
				// Set session for admin
				$this->session->set_userdata([
					'role' => 'admin',
				]);

				redirect('admin');
			}

			$pasien = $this->M_dokter->login_dokter($fullname, $alamat);
			if ($pasien) {
				$this->session->set_userdata([
					'id_pasien' => $pasien->id,
					'role' => 'pasien',
				]);

				redirect('pasien');
			} else {
				$this->session->set_flashdata('error', 'Nama atau Alamat salah.');
				redirect('pasien/login_pasien');
			}
		}
	}
}