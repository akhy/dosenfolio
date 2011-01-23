<?php

class Seminar extends Controller {

	function Seminar()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Seminar');
		$this->Seminar->initialize('seminar');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Seminar->getOne_where('seminar_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Seminar->delete($id);
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
		$data['seminar'] = $this->input->post('seminar');

		$this->Seminar->insert($data);
		redirect(ADM_URL . '/dosen/index#seminar', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Seminar->getOne_where('seminar_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$seminar = $this->Seminar->getOne($id);
			$data['seminar_id'] = $id;
			$data['jenis'] = $seminar->jenis;		
			$data['judul'] = $seminar->judul;
			$data['tahun'] = $seminar->tahun;
			$data['seminar'] = $seminar->seminar;
			
			$this->load->view(ADM_URL . '/form_seminar_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$seminar_id = $this->input->post('seminar_id');
		$data['jenis'] = $this->input->post('jenis');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['seminar'] = $this->input->post('seminar');

		$this->Seminar->update($seminar_id, $data);
		redirect(ADM_URL . '/dosen/index#seminar', 'location');
	}
}