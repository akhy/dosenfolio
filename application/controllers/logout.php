<?php

class Logout extends Controller {

	function Logout()
	{
		parent::Controller();

	}
	
	function index()
	{
		$this->session->sess_destroy();
		$this->load->view('form_login', array('pesan' => 'You have been logged out. ' . anchor('', 'Click here') . ' to get back to main page.',
			'class' => 'info'
		));
	}
}