<?php

class Beasiswa extends Controller {

	function Beasiswa()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Beasiswa');
		$this->Beasiswa->initialize('beasiswa');
	}
	
	function index()
	{

	}
	
	function delete($id)
	{
		$this->Beasiswa->delete($id);
		redirect(ADM_URL . '/dosen/index', 'location');
	}
	
	function add()
	{
		$data['dosen_id'] = $this->input->post('dosen_id');
		$data['nama'] = $this->input->post('nama');
		$data['instansi'] = $this->input->post('instansi');
		$data['tahun'] = $this->input->post('tahun');

		$this->Beasiswa->insert($data);
		redirect(ADM_URL . '/dosen/index#beasiswa', 'location');
	}
	
	function edit($id)
	{
		$beasiswa = $this->Beasiswa->getOne($id);
		$data['pendidikan_id'] = $id;
		$data['nama'] = $beasiswa->nama;		
		$data['instansi'] = $beasiswa->instansi;
		$data['tahun'] = $beasiswa->tahun;

		$this->load->view(ADM_URL . '/form_beasiswa_edit', $data);
	}
	
	function edit_p()
	{
		$beasiswa_id = $this->input->post('beasiswa_id');
		$data['nama'] = $this->input->post('nama');
		$data['instansi'] = $this->input->post('instansi');
		$data['tahun'] = $this->input->post('tahun');

		$this->Beasiswa->update($beasiswa_id, $data);
		redirect(ADM_URL . '/dosen/index#beasiswa', 'location');
	}
}