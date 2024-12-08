<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	private function set_validation_rules($type)
	{
		$rules = [
			'register_pasien' => [
				['field' => 'nama', 'label' => 'Fullname', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required|min_length[5]'],
				['field' => 'no_ktp', 'label' => 'No KTP', 'rules' => 'required|min_length[5]'],
				['field' => 'no_hp', 'label' => 'No HP', 'rules' => 'required|min_length[5]']
			],
			'login_pasien' => [
				['field' => 'nama', 'label' => 'Fullname', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required|min_length[5]']
			],
			'login_dokter' => [
				['field' => 'nama', 'label' => 'Fullname', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required|min_length[5]']
			]
		];

		if (isset($rules[$type])) {
			$this->form_validation->set_rules($rules[$type]);
		}
	}

	public function register_pasien()
	{
		$this->set_validation_rules('register_pasien');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('pasien/v_register_pasien');
		} else {
			$fullname = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$no_ktp = $this->input->post('no_ktp');
			$no_hp = $this->input->post('no_hp');

			$this->db->where('no_ktp', $no_ktp);
			$existing_patient = $this->db->get('tbl_pasien')->row();

			if ($existing_patient) {
				$this->session->set_flashdata('error', 'Pasien dengan No KTP tersebut sudah terdaftar.');
				redirect('auth/register_pasien');
			} else {
				$no_rm = $this->M_auth->generate_no_rm();

				$data = [
					'no_rm' => $no_rm,
					'nama' => $fullname,
					'alamat' => $alamat,
					'no_ktp' => $no_ktp,
					'no_hp' => $no_hp
				];

				$this->M_auth->insert_pasien($data);
				$this->session->set_flashdata('success', 'Pasien berhasil terdaftar dengan No RM: ' . $no_rm);
				redirect('auth/register_pasien');
			}
		}
	}

	public function login_pasien()
	{
		$this->set_validation_rules('login_pasien');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('pasien/v_login_pasien');
		} else {
			$fullname = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			$pasien = $this->M_auth->login_pasien($fullname, $alamat);
			if ($pasien) {
				$this->session->unset_userdata(['id_pasien', 'id_dokter', 'role']);

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

	public function login_dokter()
	{
		$this->set_validation_rules('login_dokter');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dokter/v_login_dokter');
		} else {
			$fullname = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			if ($fullname === 'admin' && $alamat === 'admin') {
				$this->session->unset_userdata(['id_pasien', 'id_dokter', 'role']);

				$this->session->set_userdata([
					'role' => 'admin',
				]);

				redirect('admin');
			}

			$dokter = $this->M_auth->login_dokter($fullname, $alamat);
			if ($dokter) {
				$this->session->unset_userdata(['id_pasien', 'id_dokter', 'role']);

				$this->session->set_userdata([
					'id_dokter' => $dokter->id,
					'role' => 'dokter',
				]);

				redirect('dokter');
			} else {
				$this->session->set_flashdata('error', 'Nama atau Alamat salah.');
				redirect('auth/login_dokter');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect('/');
	}
}
