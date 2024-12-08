<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_pasien');
		$this->load->model('M_auth');
		$this->isLogin();
	}

	private function set_validation_rules($type)
	{
		$rules = [
			'tambah_poli' => [
				['field' => 'nama_poli', 'label' => 'Nama Poli', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'keterangan', 'label' => 'Keterangan', 'rules' => 'required|min_length[5]']
			],
			'tambah_dokter' => [
				['field' => 'nama', 'label' => 'Nama Dokter', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required|min_length[5]'],
				['field' => 'no_hp', 'label' => 'No HP', 'rules' => 'required|min_length[5]'],
				['field' => 'id_poli', 'label' => 'Poli', 'rules' => 'required']
			],
			'tambah_obat' => [
				['field' => 'nama_obat', 'label' => 'Nama Obat', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'kemasan', 'label' => 'Kemasan', 'rules' => 'required|min_length[5]'],
				['field' => 'harga', 'label' => 'Harga', 'rules' => 'required']
			],
			'tambah_pasien' => [
				['field' => 'nama', 'label' => 'Nama Pasien', 'rules' => 'required|min_length[3]|max_length[255]'],
				['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required|min_length[5]'],
				['field' => 'no_ktp', 'label' => 'No KTP', 'rules' => 'required|min_length[5]'],
				['field' => 'no_hp', 'label' => 'No HP', 'rules' => 'required'],
				['field' => 'no_rm', 'label' => 'No RM', 'rules' => 'required']
			]
		];

		if (isset($rules[$type])) {
			$this->form_validation->set_rules($rules[$type]);
		}
	}
	public function index()
	{
		$data = array(
			'menu' => 'Admin',
			'title' => 'Dashboard',
			'dokter' => $this->M_admin->get_dokter_count(),
			'pasien' => $this->M_admin->get_pasien_count(),
			'poli' => $this->M_admin->get_poli_count(),
			'obat' => $this->M_admin->get_obat_count(),
			'isi' => 'admin/v_dashboard_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function dokter()
	{
		$data = array(
			'menu' => 'Admin',
			'title' => 'Dokter',
			'dokter' => $this->M_admin->get_dokter(),
			'poli' => $this->M_admin->get_poli(),
			'isi' => 'admin/v_dokter_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function pasien()
	{
		$data = array(
			'menu' => 'Admin',
			'title' => 'Pasien',
			'pasien' => $this->M_admin->get_pasien(),
			'no_rm' => $this->M_auth->generate_no_rm(),
			'isi' => 'admin/v_pasien_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function poli()
	{
		$data = array(
			'menu' => 'Admin',
			'title' => 'Poli',
			'poli' => $this->M_admin->get_poli(),
			'isi' => 'admin/v_poli_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function obat()
	{
		$data = array(
			'menu' => 'Admin',
			'title' => 'Obat',
			'obat' => $this->M_admin->get_obat(),
			'isi' => 'admin/v_obat_admin'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function tambah_poli()
	{
		$this->set_validation_rules('tambah_poli');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'menu' => 'Admin',
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
		$this->set_validation_rules('tambah_dokter');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'menu' => 'Admin',
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

	public function tambah_obat()
	{
		$this->set_validation_rules('tambah_obat');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'menu' => 'Admin',
				'title' => 'Obat',
				'obat' => $this->M_admin->get_obat(),
				'isi' => 'admin/v_obat_admin'
			);

			$this->session->set_flashdata('error', 'Gagal menambah obat. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$nama_obat = $this->input->post('nama_obat');
			$kemasan = $this->input->post('kemasan');
			$harga = $this->input->post('harga');

			$this->db->where('nama_obat', $nama_obat);
			$existing_obat = $this->db->get('tbl_obat')->row();

			if ($existing_obat) {
				$this->session->set_flashdata('error', 'Obat tersebut sudah terdaftar.');
				redirect('admin/obat');
			} else {
				$data = [
					'nama_obat' => $nama_obat,
					'kemasan' => $kemasan,
					'harga' => $harga
				];

				$this->M_admin->insert_obat($data);
				$this->session->set_flashdata('success', 'Obat berhasil ditambahkan.');
				redirect('admin/obat');
			}
		}
	}

	public function edit_obat($id = NULL)
	{
		$data = array(
			'id' => $id,
			'nama_obat' => $this->input->post('nama_obat'),
			'kemasan' => $this->input->post('kemasan'),
			'harga' => $this->input->post('harga')
		);
		$this->M_admin->edit_obat($data);
		$this->session->set_flashdata('success', 'Obat berhasil diedit');
		redirect('admin/obat');
	}

	public function delete_obat($id = NULL)
	{
		$data = array('id' => $id);
		$this->M_admin->delete_obat($data);
		$this->session->set_flashdata('success', 'Obat berhasil dihapus');
		redirect('admin/obat');
	}

	public function tambah_pasien()
	{
		$this->set_validation_rules('tambah_pasien');

		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'menu' => 'Admin',
				'title' => 'Pasien',
				'pasien' => $this->M_admin->get_pasien(),
				'no_rm' => $this->M_auth->generate_no_rm(),
				'isi' => 'admin/v_pasien_admin'
			);
			$this->session->set_flashdata('error', 'Gagal menambah pasien. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$no_ktp = $this->input->post('no_ktp');
			$no_hp = $this->input->post('no_hp');
			$no_rm = $this->input->post('no_rm');

			$this->db->where('no_ktp', $no_ktp);
			$existing_pasien = $this->db->get('tbl_pasien')->row();

			if ($existing_pasien) {
				$this->session->set_flashdata('error', 'Pasien tersebut sudah terdaftar.');
				redirect('admin/pasien');
			} else {
				$data = [
					'nama' => $nama,
					'alamat' => $alamat,
					'no_ktp' => $no_ktp,
					'no_hp' => $no_hp,
					'no_rm' => $no_rm
				];

				$this->M_admin->insert_pasien($data);
				$this->session->set_flashdata('success', 'Pasien berhasil ditambahkan.');
				redirect('admin/pasien');
			}
		}
	}

	public function edit_pasien($id = NULL)
	{
		$data = array(
			'id' => $id,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_ktp' => $this->input->post('no_ktp'),
			'no_hp' => $this->input->post('no_hp'),
			'no_rm' => $this->input->post('no_rm')
		);
		$this->M_admin->edit_pasien($data);
		$this->session->set_flashdata('success', 'Pasien berhasil diedit');
		redirect('admin/pasien');
	}

	public function delete_pasien($id = NULL)
	{
		$data = array('id' => $id);
		$this->M_admin->delete_pasien($data);
		$this->session->set_flashdata('success', 'Pasien berhasil dihapus');
		redirect('admin/pasien');
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'admin') {
			redirect('auth/login_dokter');
		}
	}
}