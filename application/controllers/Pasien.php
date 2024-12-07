<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pasien');
	}

	public function index()
	{
		$id_pasien = $this->session->userdata('id_pasien');

		if (!$id_pasien) {
			redirect('auth/login_pasien');
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
		$this->load->view('pasien/v_login_pasien', FALSE);
	}

	public function register()
	{
		$this->load->view('pasien/v_register_pasien', FALSE);
	}

	public function poli()
	{
		$id_pasien = $this->session->userdata('id_pasien');

		$data = array(
			'title' => 'Poli',
			'detail_akun' => $this->M_pasien->get_akun($id_pasien),
			'isi' => 'pasien/v_poli_pasien'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function register_pasien()
	{
		$this->form_validation->set_rules('nama', 'Fullname', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
		$this->form_validation->set_rules('no_ktp', 'No KTP', 'required|numeric');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|numeric');

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
				redirect('pasien/register');
			} else {
				$no_rm = $this->M_pasien->generate_no_rm();

				$data = [
					'no_rm' => $no_rm,
					'nama' => $fullname,
					'alamat' => $alamat,
					'no_ktp' => $no_ktp,
					'no_hp' => $no_hp
				];

				$this->M_pasien->insert_pasien($data);
				$this->session->set_flashdata('success', 'Pasien berhasil terdaftar dengan No RM: ' . $no_rm);
				redirect('pasien/register');
			}
		}
	}
}
