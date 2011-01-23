<?php

class Staff extends Controller {

	function Staff()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen'); 
		$this->Dosen->initialize('dosen');
		
		$this->load->model('Dbku', 'Karya');
		$this->Karya->initialize('karya');
		
		$this->load->model('Dbku', 'Kategori');
		$this->Kategori->initialize('kategori');
		
		////////////////////////////////////////////
		
		$this->load->model('Dbku', 'Pendidikan');
		$this->Pendidikan->initialize('pendidikan');
		
		$this->load->model('Dbku', 'Jabatan');
		$this->Jabatan->initialize('jabatan');
		
		$this->load->model('Dbku', 'Makul');
		$this->Makul->initialize('makul');
		
		$this->load->model('Dbku', 'Buku');
		$this->Buku->initialize('buku');
		
		$this->load->model('Dbku', 'Bimbingan');
		$this->Bimbingan->initialize('bimbingan');
		
		$this->load->model('Dbku', 'Publikasi');
		$this->Publikasi->initialize('publikasi');
		
		$this->load->model('Dbku', 'Seminar');
		$this->Seminar->initialize('seminar');
				
		$this->load->model('Dbku', 'Kegiatan');
		$this->Kegiatan->initialize('kegiatan');
		
		$this->load->model('Dbku', 'Penelitian');
		$this->Penelitian->initialize('penelitian');
				
		$this->load->model('Dbku', 'Penghargaan');
		$this->Penghargaan->initialize('penghargaan');
		
		$this->load->model('Dbku', 'Beasiswa');
		$this->Beasiswa->initialize('beasiswa');		
		
		$this->load->model('Dbku', 'Organisasi');
		$this->Organisasi->initialize('organisasi');	

		
		$this->load->model('Foto');
		$this->load->helper('typography');
		$this->load->library('table');
	}
	
	function index ()
	{
		if ( $this->input->post('searchString') )
		{
			$search = $this->input->post('searchString');
			
			if ($this->Dosen->count('nama', $search) > 0)
			{
				$dosen = $this->Dosen->getOne_where('nama', $search);
				$slug = url_title($dosen->nama, 'dash', TRUE) . '-' . $dosen->dosen_id;
				$this->view($slug);
			}
			else
			{
				$dosens = $this->Dosen->get_where_like('nama', $search);
				
				$data['dosens'] = $dosens;
				$data['active'] = '';
				
				$this->load->view('view_staff_all', $data);
			}
		}
		else
		{
			$this->all();
		}
	}
	
	function getId_fromSlug($slug)
	{
		$slugs = explode('.pdf', $slug);
		$slugs = $slugs[0];
		$slugs = explode('-', $slug);
		$lastIndex = count($slugs) - 1;
		$id = $slugs[$lastIndex];
		return $id;
	}
	
	function all()
	{
		$dosens = $this->Dosen->get();
		$data['dosens'] = $dosens;
		$this->load->view('view_staff_all', $data);
	}
	
	function view($slug)
	{
		$id = $this->getId_fromSlug($slug);
		
		$dosens = $this->Dosen->get();
		$data['dosens'] = $dosens;
		
		$dosen = $this->Dosen->getOne($id);
		$data['dosen'] = $dosen;
		
		$data['isSingle'] = TRUE;	
			
		$this->load->view('view_staff', $data);
	}
	
	function curriculum_vitae($slug)
	{
		$this->load->plugin('to_pdf');
		
		$id = $this->getId_fromSlug($slug);
		
		
		$dosen = $this->Dosen->getOne($id);
		$data['dosen'] = $dosen;
		
		
		
		$html = $this->load->view('view_staff_safe', $data, TRUE);
		pdf_create($html, $dosen->nama);
	}
	
	function printable($slug)
	{
		$id = $this->getId_fromSlug($slug);
		
		
		$dosen = $this->Dosen->getOne($id);
		$data['dosen'] = $dosen;
		
		
		$this->load->view('view_staff_safe', $data);
		

	}
}