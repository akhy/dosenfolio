<?php

class Otoritas extends Model {

	function Otoritas()
	{
		parent::Model();
	}
	
	function hasRights(){
		if ($this->session->userdata('tipe') != FALSE)
		{
			return TRUE;
		}
		return FALSE;
	}
	function isDosen(){
		if ($this->session->userdata('tipe') == 'dosen')
		{
			return TRUE;
		}
		return FALSE;
	}
	function isAdmin(){
		if ($this->session->userdata('tipe') == 'admin')
		{
			return TRUE;
		}
		return FALSE;
	}
	
	function getId()
	{
		return $this->session->userdata('dosen_id');
	}
	function getNoInduk()
	{
		return $this->session->userdata('username');
	}
	function getNama()
	{
		return $this->session->userdata('nama');
	}
	
}