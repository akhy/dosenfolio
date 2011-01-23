<?php

class Foto extends Model {

	function Foto()
	{
		parent::Model();	
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
	}
	
	function getFoto($id, $size = 150)
	{
		$dosen = $this->Dosen->getOne($id);
		if ($dosen != NULL)
		{
			if ($dosen->gravatar == 1)
			{
				$this->load->helper('email');
				$mail = getFirstMail($dosen->email);
				if (valid_email($mail))
				{
					$grav = 'http://www.gravatar.com/avatar/' . md5($mail) . 
						'?s=' . $size . '&d=' . urlencode(base_url() . FOTO_URL . $dosen->foto);
					return $grav;
				} 
				else
				{
					return FOTO_URL . $dosen->foto;
				}
			}
			else
			{
				return FOTO_URL . $dosen->foto;
			}
		}	
		else
		{
			return FOTO_URL . 'default.jpg';
		}
	}
}