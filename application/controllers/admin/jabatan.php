<?php

class Jabatan extends Controller {

	function Jabatan()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Jabatan');
		$this->Jabatan->initialize('jabatan');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Jabatan->getOne_where('jabatan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Jabatan->delete($id);
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
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_keluar'] = $this->input->post('thn_keluar');
		$data['institusi'] = $this->input->post('institusi');

		$this->Jabatan->insert($data);
		redirect(ADM_URL . '/dosen/index#jabatan', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Jabatan->getOne_where('jabatan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$jabatan = $this->Jabatan->getOne($id);
			$data['jabatan_id'] = $id;
			$data['nama'] = $jabatan->nama;		
			$data['institusi'] = $jabatan->institusi;
			$data['thn_masuk'] = $jabatan->thn_masuk;
			$data['thn_keluar'] = $jabatan->thn_keluar;
	
			$this->load->view(ADM_URL . '/form_jabatan_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$jabatan_id = $this->input->post('jabatan_id');
		$data['nama'] = $this->input->post('nama');
		$data['institusi'] = $this->input->post('institusi');
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_keluar'] = $this->input->post('thn_keluar');

		$this->Jabatan->update($jabatan_id, $data);
		redirect(ADM_URL . '/dosen/index#jabatan', 'location');
	}
}