<?php

class Auth extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('Model_auth');
		
	}
	
	function index()
	{
    $data['title'] = 'Login';
    $this->load->view('auth/header', $data);
		$this->load->view('auth/login');
    $this->load->view('auth/footer');
	}
	
	function login_proses()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
    $user = $this->db->get_where('mahasiswa', ['email' => $email])->row_array();
		
		$where = array(
			'email'=>$email,
			'password'=>md5($pass)
		);
		$cek = $this->Model_auth->cek_login('mahasiswa',$where)->num_rows();

		if($user){
      if($user['status'] == 2){
        $this->session->set_flashdata('msg', '
        <div class="position-fixed" style="z-index: 11">
          <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-semibold">Notifikasi</div>
              <small>Now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Akun anda telah di suspend.
            </div>
          </div>
        </div>
				');
        $log = [
          'nama' => $user['nama'],
          'user' => $email,
          'pass' => $pass,
          'ket' => 'suspend',
          'ip'=> $_SERVER['REMOTE_ADDR'],
          'http'=> $_SERVER['HTTP_USER_AGENT']
        ];
        $this->db->insert('log', $log);
        redirect(base_url('auth'));  
      }elseif($cek > 0 ){
          $sesi = array(
            'email'=>$email,
            'nama'=>$user['nama'],
            'nim'=>$user['nim'],
            'status'=>"login"
            );
        $this->session->set_userdata($sesi);
        $log = [
          'nama' => $user['nama'],
          'user' => $email,
          'pass' => $pass,
          'ket' => 'sukses',
          'ip'=> $_SERVER['REMOTE_ADDR'],
          'http'=> $_SERVER['HTTP_USER_AGENT']
        ];
        $this->db->insert('log', $log);
        redirect(base_url('user/dashboard'));       
      }else{
        $this->session->set_flashdata('msg', '
        <div class="position-fixed" style="z-index: 11">
          <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-warning top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-semibold">Notifikasi</div>
              <small>Now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Password yang anda masukan salah
            </div>
          </div>
        </div>
				');
        $log = [
          'nama' => $user['nama'],
          'user' => $email,
          'pass' => $pass,
          'ket' => 'pass salah',
          'ip'=> $_SERVER['REMOTE_ADDR'],
          'http'=> $_SERVER['HTTP_USER_AGENT']
        ];
        $this->db->insert('log', $log);
        redirect(base_url('auth'));     
      }
    }else{
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Email yang anda masukan tidak terdaftar
          </div>
        </div>
      </div>
      ');
      $log = [
        'user' => $email,
        'pass' => $pass,
        'ket' => 'tdak terdaftar',
        'ip'=> $_SERVER['REMOTE_ADDR'],
        'http'=> $_SERVER['HTTP_USER_AGENT']
      ];
      $this->db->insert('log', $log);
      redirect(base_url('auth')); 
    }
	}
	
  function daftar()
	{
    $data['title'] = 'Daftar';
    $this->load->view('auth/header', $data);
		$this->load->view('auth/daftar');
    $this->load->view('auth/footer');
	}

  public function proses_daftar(){
    $email = $this->input->post('email');
    $nama = $this->input->post('nama');
    $nim = $this->input->post('nim');
    $user = $this->db->get_where('mahasiswa', ['email' => $email])->row_array();
    $ceknim = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
		if($user){
      $this->session->set_flashdata('nama', $nama);
      $this->session->set_flashdata('nim', $nim);
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-warning top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Email yang anda masukan sudah terdaftar 
          </div>
        </div>
      </div>
      ');
      redirect(base_url('auth/daftar')); 
    }elseif($ceknim){
      $this->session->set_flashdata('nama', $nama);
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-warning top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            NIM yang anda masukan sudah terdaftar 
          </div>
        </div>
      </div>
      ');
      redirect(base_url('auth/daftar')); 
    }else{
      $data = array(
        'nama' => $nama,
        'nim' => $nim,
        'email' => $this->input->post('email'),
        'password' => md5($this->input->post('password')),
        'agree' => 1,
        'status' => 0
      );
      $this->db->insert('mahasiswa',$data);
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Akun anda berhasil dibuat, Silahkan login 
          </div>
        </div>
      </div>
      ');
      redirect(base_url('auth')); 
    }
  }      

  function reset()
	{
    $data['title'] = 'Reset Password';
    $this->load->view('auth/header', $data);
		$this->load->view('auth/reset');
    $this->load->view('auth/footer');
	}

  public function proses_reset(){
    $email = $this->input->post('email');
    $user = $this->db->get_where('mahasiswa', ['email' => $email])->row_array();
		if($user){
      $karakter = 'abcdefghijklmnopqrstuvwxyz123456789';
      $password  = substr(str_shuffle($karakter), 0, 8);
      $this->db->set('password', md5($password));
      $this->db->set('agree', 0);
      $this->db->where('email', $email);
      $this->db->update('mahasiswa');
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Password anda behasil di reset, silahkan cek email kamu untuk dapat password baru.
          </div>
        </div>
      </div>
      ');
      redirect(base_url('auth')); 
    }else{
      $this->session->set_flashdata('msg', '
      <div class="position-fixed" style="z-index: 11">
        <div id="toast" class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Notifikasi</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Email yang anda masukan sudah terdaftar 
          </div>
        </div>
      </div>
      ');
      redirect(base_url('auth/reset')); 
    }
  }

	function logout()
	{
		$this->session->sess_destroy();
		$this->session->userdata('status')==" ";
    redirect(base_url('auth'));      
	}
	
}