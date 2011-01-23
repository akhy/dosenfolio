<?php

class Dosen_mod extends Model {

	var $table_name = '';
	var $primary_key = '';
	
	function Kategori_mod()
	{
		parent::Model();	
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
	}
	
	function getDosenName($id)
	{
		$dosen = $this->Dosen->getOne($id);
		if ($dosen != NULL)
			return $dosen->nama;
		else
			return NULL;
	}
	function getFoto($id)
	{
		$dosen = $this->Dosen->getOne($id);
		if ($dosen != NULL)
		{
			
			if ($dosen->gravatar == 1)
			{
				$this->load->helper('email');
				$email = getFirstMail($dosen->email); 
				return 'http://www.gravatar.com/avatar.php?gravatar_id=' . md5($email) . '&amp;size=150';
			}
			else
			{
				return FOTO_URL . $dosen->foto;
			}
		}
	}
}