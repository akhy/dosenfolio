<?php

class Publikasi extends Controller {

	function Publikasi()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Publikasi');
		$this->Publikasi->initialize('publikasi');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Publikasi->getOne_where('publikasi_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Publikasi->delete($id);
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
		$data['jenis'] = $this->input->post('jenis');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['posisi'] = $this->input->post('posisi');
		$data['media'] = $this->input->post('media');

		$this->Publikasi->insert($data);
		redirect(ADM_URL . '/dosen/index#publikasi', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Publikasi->getOne_where('publikasi_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$publikasi = $this->Publikasi->getOne($id);
			$data['publikasi_id'] = $id;
			$data['jenis'] = $publikasi->jenis;		
			$data['judul'] = $publikasi->judul;
			$data['tahun'] = $publikasi->tahun;
			$data['posisi'] = $publikasi->posisi;
			$data['media'] = $publikasi->media;
			
			$this->load->view(ADM_URL . '/form_publikasi_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$publikasi_id = $this->input->post('publikasi_id');
		$data['jenis'] = $this->input->post('jenis');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['posisi'] = $this->input->post('posisi');
		$data['media'] = $this->input->post('media');

		$this->Publikasi->update($publikasi_id, $data);
		redirect(ADM_URL . '/dosen/index#publikasi', 'location');
	}
}