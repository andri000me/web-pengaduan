<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		// load model
		$this->load->model('Auth_model');
		$this->load->model('Masyarakat_model');
	}

	public function index()
	{

		if ($this->session->userdata('id')) {
			if ($this->session->userdata('level') == "admin") {
				redirect('admin');
			} elseif ($this->session->userdata('level') == "petugas") {
				redirect('petugas');
			} else {
				redirect('masyarakat');
			}
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header');
			$this->load->view('templates/auth_footer');
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}

	public function daftar()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header');
			$this->load->view('templates/auth_footer');
			$this->load->view('auth/daftar');
		} else {
			$this->_daftar();
		}
	}

	private function _daftar()
	{
		// tambah user
		$data = [
			'email' => $this->input->post('email', TRUE),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'level' => 'masyarakat'
		];
		$this->Auth_model->tambah_user($data);
		
		$dataMasyarakat = [
			'nik' => $this->input->post('nik', TRUE),
			'nama' => $this->input->post('nama', TRUE),
			'telp' => $this->input->post('telp', TRUE),
			'id_login' => $this->Auth_model->get_user_terakhir()->ID_LOGIN
		];
		$this->Masyarakat_model->tambah_masyarakat($dataMasyarakat);

		$this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Selamat.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button></div>');
		redirect('auth');
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('login', ['email' => $email])->row_array();
		// jika user ditemukan
		if ($user) {
			// jika password benar
			if (password_verify($password, $user['password']))
			// simpan data ke session
			{
				$data = [
					'id' => $user['id_login'],
					'level' => $user['level']
				];
				$this->session->set_userdata($data);
				// redirect('user');
				// level manajemen login ( admin,petugas dan masyarakat)
				if ($user['level'] == "admin") {
					redirect('admin');
				} elseif ($user['level'] == "petugas") {
					redirect('petugas');
				} else {
					redirect('masyarakat');
				}
			} else {
				// jika password salah
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">email atau password Anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('auth');
			}
		} else {
			// jika email belum terdaftar
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">email atau password Anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>');
			redirect('auth');
		}
	}

	public function ubah_password()
	{
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'trim|required|matches[password_konfirmasi]');
		$this->form_validation->set_rules('password_konfirmasi', 'Konfirmasi Password Baru', 'trim|required|matches[password_baru]');
		if ($this->form_validation->run() == false) {
			$data['title'] = $this->session->userdata('level');
			$data['level'] = $this->session->userdata('level');
			

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('auth/ubah_password',$data);
			$this->load->view('templates/footer');

		} else {
			$this->_ubah_password();
		}
	}

	private function _ubah_password()
	{
		// $level = $this->session->userdata('level');
		$id = $this->session->userdata('id');
		$user = $this->Auth_model->get_ubah_password($id);
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		if(!password_verify($password_lama, $user['password'])){
			$this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> Password lama salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>');
			redirect('auth/ubah_password');
		}else{
			if($password_lama == $password_baru){
				$this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> Password baru tidak boleh sama dengan password lama.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('auth/ubah_password');
			}else{
				$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
				$this->Auth_model->ubah_password($id,$password_hash);
				$this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Password baru anda sudah bisa digunakan.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('auth/ubah_password');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Termikasih. Silahkan login kembali untuk masuk ke aplikasi.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button></div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/403');
	}
}
