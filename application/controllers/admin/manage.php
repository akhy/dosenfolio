<?php

class Manage extends Controller {

	function Manage()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->view(ADM_URL . '/view_manage');
	}
	function unauthorized()
	{
		$this->index();
		$this->load->view(ADM_URL . '/unauthorized');
	}
}