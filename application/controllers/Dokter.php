<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dokter');
		$this->load->model('M_admin');
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
			'jadwal_periksa' => $this->M_dokter->get_jadwal_periksa($id_dokter),
			'isi' => 'dokter/v_jadwal_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function daftar_periksa()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$daftar_periksa = $this->M_dokter->get_daftar_poli_by_dokter($id_dokter);

		foreach ($daftar_periksa as &$item) {
			$item->id_periksa = $this->M_dokter->get_periksa_by_daftar_poli($item->id);
			$item->periksa_exists = $this->M_dokter->get_periksa_by_daftar_poli($item->id) ? true : false;
		}
		usort($daftar_periksa, function ($a, $b) {
			return $a->periksa_exists <=> $b->periksa_exists;
		});

		$data = array(
			'menu' => 'Dokter',
			'title' => 'Daftar Periksa',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'daftar_periksa' => $daftar_periksa,
			'obat' => $this->M_admin->get_obat(),
			'isi' => 'dokter/v_daftar_periksa_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function riwayat_pasien()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$data = array(
			'menu' => 'Dokter',
			'title' => 'Riwayat Pasien',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'pasien' => $this->M_admin->get_pasien(),
			'isi' => 'dokter/v_riwayat_pasien_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function profil()
	{
		$id_dokter = $this->session->userdata('id_dokter');

		$data = array(
			'menu' => 'Dokter',
			'title' => 'Profil',
			'detail_akun' => $this->M_dokter->get_akun($id_dokter),
			'isi' => 'dokter/v_profil_dokter'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function edit_profil($id = NULL)
	{
		$data = array(
			'id' => $id,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp')
		);
		$this->M_dokter->edit_profil($data);
		$this->session->set_flashdata('success', 'Profil berhasil diedit');
		redirect('dokter/profil');
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
				'jadwal_periksa' => $this->M_dokter->get_jadwal_periksa($id_dokter),
				'isi' => 'dokter/v_jadwal_dokter'
			);
			$this->session->set_flashdata('error', 'Gagal menambah jadwal. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$hari = $this->input->post('hari');
			$jam_mulai = $this->input->post('jam_mulai');
			$jam_selesai = $this->input->post('jam_selesai');

			$this->db->where('hari', $hari);
			$this->db->where('id_dokter', $id_dokter);

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

	public function submit_periksa($id = NULL)
	{
		$this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('catatan', 'Catatan', 'required');

		if ($this->form_validation->run() === FALSE) {
			$id_dokter = $this->session->userdata('id_dokter');

			$daftar_periksa = $this->M_dokter->get_daftar_poli_by_dokter($id_dokter);

			foreach ($daftar_periksa as &$item) {
				$item->periksa_exists = $this->M_dokter->get_periksa_by_daftar_poli($item->id);
			}

			$data = array(
				'menu' => 'Dokter',
				'title' => 'Daftar Periksa',
				'detail_akun' => $this->M_dokter->get_akun($id_dokter),
				'daftar_periksa' => $daftar_periksa,
				'obat' => $this->M_admin->get_obat(),
				'isi' => 'dokter/v_daftar_periksa_dokter'
			);

			$this->session->set_flashdata('error', 'Gagal memeriksa. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$data_periksa = array(
				'id_daftar_poli' => $id,
				'tgl_periksa' => $this->input->post('tgl_periksa'),
				'catatan' => $this->input->post('catatan'),
				'biaya_periksa' => $this->input->post('biaya_pemeriksaan')
			);

			$obat_ids = $this->input->post('obat');

			$this->M_dokter->insert_periksa($data_periksa, $obat_ids);

			$this->session->set_flashdata('success', 'Periksa berhasil.');

			redirect('dokter/daftar_periksa');
		}
	}
	public function edit_periksa($id = NULL)
	{
		$this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('catatan', 'Catatan', 'required');

		if ($this->form_validation->run() === FALSE) {
			$id_dokter = $this->session->userdata('id_dokter');

			$daftar_periksa = $this->M_dokter->get_daftar_poli_by_dokter($id_dokter);

			foreach ($daftar_periksa as &$item) {
				$item->periksa_exists = $this->M_dokter->get_periksa_by_daftar_poli($item->id);
			}

			$data = array(
				'menu' => 'Dokter',
				'title' => 'Daftar Periksa',
				'detail_akun' => $this->M_dokter->get_akun($id_dokter),
				'daftar_periksa' => $daftar_periksa,
				'obat' => $this->M_admin->get_obat(),
				'isi' => 'dokter/v_daftar_periksa_dokter'
			);

			$this->session->set_flashdata('error', 'Gagal edit periksa. Pastikan semua kolom terisi dengan benar.');

			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$data_periksa = array(
				'id' => $id,
				'tgl_periksa' => $this->input->post('tgl_periksa'),
				'catatan' => $this->input->post('catatan'),
				'biaya_periksa' => $this->input->post('biaya_pemeriksaan')
			);

			$obat_ids = $this->input->post('obat2');

			$this->M_dokter->edit_periksa($data_periksa, $obat_ids);

			$this->session->set_flashdata('success', 'Edit periksa berhasil.');

			redirect('dokter/daftar_periksa');
		}
	}

	function isLogin()
	{
		$role = $this->session->userdata('role');

		if ($role != 'dokter') {
			redirect('auth/login_dokter');
		}
	}
}
