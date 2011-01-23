<?php

class Penelitian extends Controller {

	function Penelitian()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Penelitian');
		$this->Penelitian->initialize('penelitian');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Penelitian->getOne_where('penelitian_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Penelitian->delete($id);
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
		$data['wkt_start'] = $this->input->post('wkt_start');
		$data['wkt_end'] = $this->input->post('wkt_end');
		$data['posisi'] = $this->input->post('posisi');
		$data['sumber'] = $this->input->post('sumber');
		$data['dana'] = $this->input->post('dana');

		$this->Penelitian->insert($data);
		redirect(ADM_URL . '/dosen/index#penelitian', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Penelitian->getOne_where('penelitian_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$penelitian = $this->Penelitian->getOne($id);
			$data['penelitian_id'] = $id;
			$data['judul'] = $penelitian->judul;		
			$data['wkt_start'] = $penelitian->wkt_start;
			$data['wkt_end'] = $penelitian->wkt_end;
			$data['posisi'] = $penelitian->posisi;
			$data['sumber'] = $penelitian->sumber;
			$data['dana'] = $penelitian->dana;
	
			$this->load->view(ADM_URL . '/form_penelitian_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$penelitian_id = $this->input->post('penelitian_id');
		$data['judul'] = $this->input->post('judul');
		$data['wkt_start'] = $this->input->post('wkt_start');
		$data['wkt_end'] = $this->input->post('wkt_end');
		$data['posisi'] = $this->input->post('posisi');
		$data['sumber'] = $this->input->post('sumber');
		$data['dana'] = $this->input->post('dana');

		$this->Penelitian->update($penelitian_id, $data);
		redirect(ADM_URL . '/dosen/index#penelitian', 'location');
	}
}