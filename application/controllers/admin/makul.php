<?php

class Makul extends Controller {

	function Makul()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Makul');
		$this->Makul->initialize('makul');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Makul->getOne_where('makul_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Makul->delete($id);
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
		$data['tahun'] = $this->input->post('tahun');
		$data['semester'] = $this->input->post('semester');

		$this->Makul->insert($data);
		redirect(ADM_URL . '/dosen/index#makul', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Makul->getOne_where('makul_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$makul = $this->Makul->getOne($id);
			$data['makul_id'] = $id;
			$data['nama'] = $makul->nama;		
			$data['tahun'] = $makul->tahun;
			$data['semester'] = $makul->semester;
	
			$this->load->view(ADM_URL . '/form_makul_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$makul_id = $this->input->post('makul_id');
		$data['nama'] = $this->input->post('nama');
		$data['tahun'] = $this->input->post('tahun');
		$data['semester'] = $this->input->post('semester');

		$this->Makul->update($makul_id, $data);
		redirect(ADM_URL . '/dosen/index#makul', 'location');
	}
}