<?php

class Karya extends Controller {

	function Karya()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Kategori');
		$this->Kategori->initialize('kategori');
		
		$this->load->model('Dbku', 'Karya');
		$this->Karya->initialize('karya');
		
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
		$this->load->model('Kategori_mod');
		$this->load->model('Dosen_mod');
	}
	
	function index()
	{
		if ( $this->Otoritas->isDosen() )
		{
			$this->dosen($this->Otoritas->getId());
		}
		elseif ( $this->Otoritas->isAdmin()	)
		{
			$this->dosen();
		}
		
	}
	
	function dosen($id = NULL)
	{
		$this->load->view(ADM_URL . '/tpl_header');
		
		$data['kat'] = $this->get_kategori_array();
		$data['dos'] = $this->get_dosen_array();
		$data['referrer'] = 'dosen#portofolio';
		$this->load->view(ADM_URL . '/form_karya_add', $data);
		
		if ($id != NULL)
		{
			$karyas = $this->Karya->get_where('dosen_id', $id);
		}
		else 
		{
			$karyas = $this->Karya->get();
		}
		foreach($karyas as $karya)
		{
			$this->load->view(ADM_URL . '/view_a_karya', array('karya' => $karya));
		}
	}
	
	function delete($id)
	{
		$dosen= $this->Karya->getOne_where('karya_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			$this->Karya->delete($id);
			redirect(ADM_URL . '/karya', 'location');
		} 
		else
		{
			$this->load->view('error');
		}
	}
	
	function add()
	{
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['kategori_id'] = $this->input->post('kategori_id');
		$data['dosen_id'] = $this->input->post('dosen_id');
		$data['deskripsi'] = $this->input->post('deskripsi');
	
		$this->Karya->insert($data);

		redirect(ADM_URL . '/' . $this->input->post('referrer'), 'location');
	}
	
	function edit($id)
	{
		$dosen= $this->Karya->getOne_where('karya_id', $id);
		$dosen_id = $dosen->dosen_id;
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen_id)
		{
			//data untuk ditampilkan di form pengeditan
			$karya = $this->Karya->getOne($id);
			$data['karya_id'] = $id;
			$data['judul'] = $karya->judul;
			$data['tahun'] = $karya->tahun;
			$data['kategori_id'] = $karya->kategori_id;
			$data['deskripsi'] = $karya->deskripsi;
			
			$data['kat'] = $this->get_kategori_array(); 
			$this->load->view(ADM_URL . '/form_karya_edit', $data);
		} 
		else
		{
			$this->load->view('error');
		}
	}
	function edit_p()
	{
		$karya_id = $this->input->post('karya_id');
		$data['judul'] = $this->input->post('judul');
		$data['tahun'] = $this->input->post('tahun');
		$data['kategori_id'] = $this->input->post('kategori_id');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$this->Karya->update($karya_id, $data);
		redirect(ADM_URL . '/karya', 'location');
	}
	
	function get_kategori_array()
	{
		$kategoris = $this->Kategori->get();
		$n = 0;
		foreach($kategoris as $kat)
		{
			$data[$n]->kategori_id = $kat->kategori_id;
			$data[$n]->nama_kat = $kat->nama_kat;
			$n++;
		}
		return $data;
	}
	function get_dosen_array()
	{
		$dosens = $this->Dosen->get();
		$n = 0;
		foreach($dosens as $dosen)
		{
			$data[$n]->dosen_id = $dosen->dosen_id;
			$data[$n]->nama = $dosen->nama;
			$n++;
		}
		return $data;
	}

}