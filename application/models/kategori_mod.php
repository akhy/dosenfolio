<?php

class Kategori_mod extends Model {

	var $table_name = '';
	var $primary_key = '';
	
	function Kategori_mod()
	{
		parent::Model();	
		$this->load->model('Dbku', 'Kategori');
		$this->Kategori->initialize('kategori');
	}
	
	function getKategoriName($id)
	{
		$kategori = $this->Kategori->getOne($id);
		if ($kategori != NULL)
			return $kategori->nama_kat;
		else
			return NULL;
	}
}