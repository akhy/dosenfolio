<?php

class Pendidikan extends Controller {

	function Pendidikan() 
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Pendidikan');
		$this->Pendidikan->initialize('pendidikan');
	}
	
	function index()
	{
		/*
		$this->load->view('admin/tpl_header');
	
		// menampilkan list dosen
		$pendidikan = $this->Pendidikan->get();
		
		foreach($pendidikan as $pend)
		{
			$data['pend'] = $pend;
			$data['data']['dosen_id'] = $dosen->dosen_id;
			$data['data']['nama'] = $dosen->nama;
			$data['data']['kat'] = $this->get_kategori_array(); 
			$data['data']['referrer'] = 'dosen';
					
			$this->load->view(ADM_URL . '/view_a_pendidikan', $data);
		}
		$this->load->view(ADM_URL . '/form_dosen_add');
		*/
	}
	
	function delete($id)
	{
		$dosen= $this->Pendidikan->getOne_where('pendidikan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Pendidikan->delete($id);
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
		$data['institusi'] = $this->input->post('institusi');
		$data['prodi'] = $this->input->post('prodi');
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_lulus'] = $this->input->post('thn_lulus');
		$data['jurusan'] = $this->input->post('jurusan');
		$data['derajat'] = $this->input->post('derajat');
		$this->Pendidikan->insert($data);
		redirect(ADM_URL . '/dosen/index#pendidikan', 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Pendidikan->getOne_where('pendidikan_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$pendidikan = $this->Pendidikan->getOne($id);
			$data['pendidikan_id'] = $id;
			$data['institusi'] = $pendidikan->institusi;
			$data['prodi'] = $pendidikan->prodi;
			$data['thn_masuk'] = $pendidikan->thn_masuk;
			$data['thn_lulus'] = $pendidikan->thn_lulus;
			$data['jurusan'] = $pendidikan->jurusan;
			$data['derajat'] = $pendidikan->derajat;
			$this->load->view(ADM_URL . '/form_pendidikan_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function edit_p()
	{
		$pendidikan_id = $this->input->post('pendidikan_id');
		$data['institusi'] = $this->input->post('institusi');
		$data['prodi'] = $this->input->post('prodi');
		$data['thn_masuk'] = $this->input->post('thn_masuk');
		$data['thn_lulus'] = $this->input->post('thn_lulus');
		$data['jurusan'] = $this->input->post('jurusan');
		$data['derajat'] = $this->input->post('derajat');
		$this->Pendidikan->update($pendidikan_id, $data);
		redirect(ADM_URL . '/dosen/index', 'location');
	}
}