<?php

class Kategori extends Controller {

	function Kategori()
	{
		parent::Controller();
		$this->load->model('Dbku', 'Kategori');
		$this->Kategori->initialize('kategori');
		
		$this->load->model('Dbku', 'Karya');
		$this->Karya->initialize('karya');
	}
	
	function index()
	{
		$this->load->view(ADM_URL . '/tpl_header');
		$this->load->view(ADM_URL . '/form_kategori_add');
		$kategoris = $this->Kategori->get();
		foreach($kategoris as $kat)
		{
			$this->load->view(ADM_URL . '/view_a_kategori', array('kat' => $kat));
		}
		
	}
	
	function delete($id)
	{
		if($this->Karya->isExist('kategori_id', $id))
		{
			// kategori dengan id tersebut digunakan pada tabel karya
			return FALSE;
		}
		else
		{
			// oke, gak ada konflik
			$this->Kategori->delete($id);
			redirect(ADM_URL . '/kategori', 'location');
		}
	}
	
	function add()
	{
		$data['nama_kat'] = $this->input->post('nama_kat');
		$this->Kategori->insert($data);
		redirect(ADM_URL . '/kategori', 'location');
	}
	
	function edit($id)
	{
		$kategori = $this->Kategori->getOne($id);
		$data['kategori_id'] = $id;
		$data['nama_kat'] = $kategori->nama_kat;
		$this->load->view(ADM_URL . '/form_kategori_edit', $data);
	}
	function edit_p()
	{
		$kategori_id = $this->input->post('kategori_id');
		$data['nama_kat'] = $this->input->post('nama_kat');
		$this->Kategori->update($kategori_id, $data);
		redirect(ADM_URL . '/kategori', 'location');
	}
	
}