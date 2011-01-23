<?php

class Kegiatan extends Controller {

	function Kegiatan()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Kegiatan');
		$this->Kegiatan->initialize('kegiatan');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Kegiatan->getOne_where('kegiatan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Kegiatan->delete($id);
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
		$data['nama'] = $this->input->post('nama');
		$data['peran'] = $this->input->post('peran');
		$data['penyelenggara'] = $this->input->post('penyelenggara');
		$data['tahun'] = $this->input->post('tahun');
		$data['tempat'] = $this->input->post('tempat');

		$this->Kegiatan->insert($data);
		redirect(ADM_URL . '/dosen/index#kegiatan', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Kegiatan->getOne_where('kegiatan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$kegiatan = $this->Kegiatan->getOne($id);
			$data['kegiatan_id'] = $id;
			$data['nama'] = $kegiatan->nama;		
			$data['peran'] = $kegiatan->peran;
			$data['penyelenggara'] = $kegiatan->penyelenggara;
			$data['tahun'] = $kegiatan->tahun;
			$data['tempat'] = $kegiatan->tempat;
	
			$this->load->view(ADM_URL . '/form_kegiatan_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$kegiatan_id = $this->input->post('kegiatan_id');
		$data['nama'] = $this->input->post('nama');
		$data['peran'] = $this->input->post('peran');
		$data['penyelenggara'] = $this->input->post('penyelenggara');
		$data['tahun'] = $this->input->post('tahun');
		$data['tempat'] = $this->input->post('tempat');

		$this->Kegiatan->update($kegiatan_id, $data);
		redirect(ADM_URL . '/dosen/index#kegiatan', 'location');
	}
}