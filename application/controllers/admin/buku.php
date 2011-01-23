<?php

class Buku extends Controller {

	function Buku()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Buku');
		$this->Buku->initialize('buku');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Buku->getOne_where('buku_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Buku->delete($id);
			redirect(ADM_URL . '/dosen/index', 'location');
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function add()
	{
		$data['dosen_id'] = $this->input->post('dosen_id');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['jenis'] = $this->input->post('jenis');
		$data['penerbit'] = $this->input->post('penerbit');
		
		$this->Buku->insert($data);
		redirect(ADM_URL . '/dosen/index#buku', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Buku->getOne_where('buku_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$buku = $this->Buku->getOne($id);
			$data['buku_id'] = $id;
			$data['judul'] = $buku->judul;		
			$data['tahun'] = $buku->tahun;
			$data['jenis'] = $buku->jenis;
			$data['penerbit'] = $buku->penerbit;
			
			$this->load->view(ADM_URL . '/form_buku_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$buku_id = $this->input->post('buku_id');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['jenis'] = $this->input->post('jenis');
		$data['penerbit'] = $this->input->post('penerbit');

		$this->Buku->update($buku_id, $data);
		redirect(ADM_URL . '/dosen/index#buku', 'location');
	}
}