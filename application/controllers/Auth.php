<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
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

			$pasien = $this->M_auth->login_dokter($fullname, $alamat);
			if ($pasien) {
				$this->session->set_userdata([
					'id_pasien' => $pasien->id,
					'role' => 'pasien',
				]);

				redirect('pasien');
			} else {
				$this->session->set_flashdata('error', 'Nama atau Alamat salah.');
				redirect('auth/login_pasien');
			}
		}
	}

	public function login_pasien()
	{
		$this->form_validation->set_rules('nama', 'Fullname', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('pasien/v_login_pasien');
		} else {
			$fullname = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			$pasien = $this->M_auth->login_pasien($fullname, $alamat);
			if ($pasien) {
				$this->session->set_userdata([
					'id_pasien' => $pasien->id,
					'role' => 'pasien',
				]);

				redirect('pasien');
			} else {
				$this->session->set_flashdata('error', 'Nama atau Alamat salah.');
				redirect('auth/login_pasien');
			}
		}
	}
}