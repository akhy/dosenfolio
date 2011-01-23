<?php

class Penghargaan extends Controller {

	function Penghargaan()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Penghargaan');
		$this->Penghargaan->initialize('penghargaan');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Penghargaan->getOne_where('penghargaan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Penghargaan->delete($id);
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
		$data['institusi'] = $this->input->post('institusi');
		$data['tahun'] = $this->input->post('tahun');

		$this->Penghargaan->insert($data);
		redirect(ADM_URL . '/dosen/index#penghargaan', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Penghargaan->getOne_where('penghargaan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$penghargaan = $this->Penghargaan->getOne($id);
			$data['penghargaan_id'] = $id;
			$data['nama'] = $penghargaan->nama;		
			$data['institusi'] = $penghargaan->institusi;
			$data['tahun'] = $penghargaan->tahun;
	
			$this->load->view(ADM_URL . '/form_penghargaan_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$penghargaan_id = $this->input->post('penghargaan_id');
		$data['nama'] = $this->input->post('nama');
		$data['institusi'] = $this->input->post('institusi');
		$data['tahun'] = $this->input->post('tahun');

		$this->Penghargaan->update($penghargaan_id, $data);
		redirect(ADM_URL . '/dosen/index#penghargaan', 'location');
	}
}