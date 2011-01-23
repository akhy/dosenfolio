<?php

class Bimbingan extends Controller {

	function Bimbingan()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Bimbingan');
		$this->Bimbingan->initialize('bimbingan');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Bimbingan->getOne_where('bimbingan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Bimbingan->delete($id);
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
		$data['strata'] = $this->input->post('strata');
		$data['jumlah'] = $this->input->post('jumlah');
		$data['tahun'] = $this->input->post('tahun');
		$data['prodi'] = $this->input->post('prodi');

		$this->Bimbingan->insert($data);
		redirect(ADM_URL . '/dosen/index#bimbingan', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Bimbingan->getOne_where('bimbingan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$bimbingan = $this->Bimbingan->getOne($id);
			$data['bimbingan_id'] = $id;
			$data['strata'] = $bimbingan->strata;		
			$data['jumlah'] = $bimbingan->jumlah;
			$data['tahun'] = $bimbingan->tahun;
			$data['prodi'] = $bimbingan->prodi;
	
			$this->load->view(ADM_URL . '/form_bimbingan_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$bimbingan_id = $this->input->post('bimbingan_id');
		$data['strata'] = $this->input->post('strata');
		$data['jumlah'] = $this->input->post('jumlah');
		$data['tahun'] = $this->input->post('tahun');
		$data['prodi'] = $this->input->post('prodi');

		$this->Bimbingan->update($bimbingan_id, $data);
		redirect(ADM_URL . '/dosen/index#bimbingan', 'location');
	}
}