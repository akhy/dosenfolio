<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
		$this->load->model('Foto');
	}
	
	function index()
	{
		$data['dosens'] = $this->Dosen->get(NULL, NULL, FALSE, 'random');
		$data['isHome'] = TRUE;
		$this->load->view('view_home', $data);
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */