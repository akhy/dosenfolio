<?php

class Password extends Controller {

	function Password() 
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
		$this->load->model('Konfig_mod');
	}
	
	function index()
	{	
		// validasi form
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert">', '</div>');
		$this->form_validation->set_rules('pass_old', 'old password', 'required');
		$this->form_validation->set_rules('pass_new', 'new password', 'required');
		$this->form_validation->set_rules('pass_conf', 'password confirmation', 'matches[pass_new]');
		
		$data = array('pesan' => '', 'class' => '');
		
		if ($this->form_validation->run() != FALSE)
		{
			$pass_old = $this->input->post('pass_old');
			$pass_new = $this->input->post('pass_new');
			$pass_conf = $this->input->post('pass_conf');
			
			
			
			// bila admin
			if ($this->Otoritas->isAdmin())
			{
				$old_valid = (md5($pass_old) == $this->Konfig_mod->get('admin_password'));
				$new_valid = ($pass_new == $pass_conf);
				if ($old_valid && $new_valid)
				{
					$this->Konfig_mod->set('admin_password', md5($pass_new));
					$data['pesan'] = 'Password berhasil diubah';
					$data['class'] = 'info';
				}
				else
				{
					$data['pesan'] = 'Password tidak cocok';
					$data['class'] = 'alert';
				}
			} 
			// bila dosen
			elseif ($this->Otoritas->isDosen())
			{	
				$cid = $this->Otoritas->getId();
				
				$dos = $this->Dosen->getOne($cid);
				$old_valid = (md5($pass_old) == $dos->pass);
				$new_valid = ($pass_new == $pass_conf);
				
				if ($old_valid && $new_valid)
				{
					$this->Dosen->update($cid, array('pass' => md5($pass_new)));
					$data['pesan'] = 'Password berhasil diubah';
					$data['class'] = 'info';
				}
				else
				{
					$data['pesan'] = 'Password tidak cocok';
					$data['class'] = 'alert';
				}
			}
			
			
		}
		$this->load->view(ADM_URL . '/form_password', $data);
	}
	
}