<?php

class About extends Controller {

	function About()
	{
		parent::Controller();	
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		$this->load->model('Foto');
	}
	
	function index()
	{
		$data['dosens'] = $this->Dosen->get();
		$data['isAbout'] = TRUE;
		$this->load->view('view_home', $data);
	}
}
