<?php

class Login extends Controller {
	function Login()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
		$this->load->model('Konfig_mod');
		$this->load->model('Foto');
	}

	
	function index()
	{

		// validasi form
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert">', '</div>');
		$this->form_validation->set_rules('user', 'Username', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		
		$data = array('pesan' => '', 'class' => '');
		
		if ($this->form_validation->run() != FALSE)
		{
			// isian benar, cek mari ngecek user/pass-nya valid gak nih
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			
			// cek dulu usernamenya punya admin bukan
			if ($user == $this->Konfig_mod->get('admin_username'))
			{
				// ternyata yang login itu admin, tapi bener gak passwordnya
				if (md5($pass) == $this->Konfig_mod->get('admin_password'))
				{
					// hore, si admin bener masukin passwordnya
					$this->session->set_userdata('nama', 'Administrator');
					$this->session->set_userdata('tipe', 'admin');
					
					redirect(ADM_URL . '/manage', 'location');
				}
				else
				{	
					// mimin gadungan nih
					$data['pesan'] = 'Password salah';
					$data['class'] = 'alert';
				}
			} 
			else
			{
				// ternyata bukan admin, cek masuk list dosen gak
				$row = $this->Dosen->getOne_where('username', $user);
				if (! $row)
				{
					// user tidak ditemukan, gagal deh
					$data['pesan'] = 'Username tidak ditemukan dalam sistem';
					$data['class'] = 'alert';
				} 
				else
				{
					// ada usernya, cek password ah
					if ($row->pass == md5($pass))
					{
						// berhasil, passwordnya benar
						$this->session->set_userdata('dosen_id', $row->dosen_id);
						$this->session->set_userdata('username', $user);
						$this->session->set_userdata('nama', $row->nama);
						$this->session->set_userdata('tipe', 'dosen');
						$this->session->set_userdata('foto', $this->Foto->getFoto($row->dosen_id));
						
						redirect(ADM_URL . '/manage', 'location');
					} 
					else 
					{
						// passwordnya salah, say
						$data['pesan'] = 'Password salah';
						$data['class'] = 'alert';
					}
				}
			}
		}
		else
		{
			// isian salah
		}
		
		$this->load->view('form_login', $data);
		
	}
	
}