<?php

class Organisasi extends Controller {

	function Organisasi()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Organisasi');
		$this->Organisasi->initialize('organisasi');
	}
	
	function index()
	{
	}
	
	function delete($id)
	{
		$dosen= $this->Organisasi->getOne_where('organisasi_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Organisasi->delete($id);
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
		$data['posisi'] = $this->input->post('posisi');
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_keluar'] = $this->input->post('thn_keluar');
		$data['tempat'] = $this->input->post('tempat');

		$this->Organisasi->insert($data);
		redirect(ADM_URL . '/dosen/index#organisasi', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Organisasi->getOne_where('organisasi_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$organisasi = $this->Organisasi->getOne($id);
			$data['organisasi_id'] = $id;
			$data['nama'] = $organisasi->nama;		
			$data['posisi'] = $organisasi->posisi;
			$data['thn_masuk'] = $organisasi->thn_masuk;
			$data['thn_keluar'] = $organisasi->thn_keluar;
			$data['tempat'] = $organisasi->tempat;
	
			$this->load->view(ADM_URL . '/form_organisasi_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$organisasi_id = $this->input->post('organisasi_id');
		$data['nama'] = $this->input->post('nama');
		$data['posisi'] = $this->input->post('posisi');
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_keluar'] = $this->input->post('thn_keluar');
		$data['tempat'] = $this->input->post('tempat');

		$this->Organisasi->update($organisasi_id, $data);
		redirect(ADM_URL . '/dosen/index#organisasi', 'location');
	}
}