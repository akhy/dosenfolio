<?php

class Dosen extends Controller {

	function Dosen()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
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
		$this->load->library('table');
	}
	
	function index()
	{
		$this->load->view('admin/tpl_header');
	
		
		if ( $this->Otoritas->isDosen() )
		{
			$dosens = $this->Dosen->get($this->Otoritas->getId());
		}
		elseif ( $this->Otoritas->isAdmin()	)
		{
			$dosens = $this->Dosen->get();
		}
		
		// tampilkan form nambah dosen, bila yang login adalah admin
		if ( $this->Otoritas->isAdmin()	)
		{
			$this->load->view(ADM_URL . '/form_dosen_add');
		}
		
		// menampilkan list dosen
		foreach($dosens as $dosen)
		{
			$data['dosen'] = $dosen;
			$data['data']['dosen_id'] = $dosen->dosen_id;
			$data['data']['nama'] = $dosen->nama;
						
			$data['data']['referrer'] = 'dosen#portofolio';
					
			$this->load->view(ADM_URL . '/view_a_dosen', $data);
		}
	}
	
	function delete($id)
	{
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $id)
		{
			// apakah ada Pendidikan milik dosen ini
			if($this->Pendidikan->isExist('dosen_id', $id))
			{
				//hapus semua Pendidikan yang terkait dengan dosen tersebut
				$this->Pendidikan->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Jabatan milik dosen ini
			if($this->Jabatan->isExist('dosen_id', $id))
			{
				//hapus semua Jabatan yang terkait dengan dosen tersebut
				$this->Jabatan->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Makul milik dosen ini
			if($this->Makul->isExist('dosen_id', $id))
			{
				//hapus semua Makul yang terkait dengan dosen tersebut
				$this->Makul->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Buku milik dosen ini
			if($this->Buku->isExist('dosen_id', $id))
			{
				//hapus semua Buku yang terkait dengan dosen tersebut
				$this->Buku->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Bimbingan milik dosen ini
			if($this->Bimbingan->isExist('dosen_id', $id))
			{
				//hapus semua Bimbingan yang terkait dengan dosen tersebut
				$this->Bimbingan->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Kegiatan milik dosen ini
			if($this->Kegiatan->isExist('dosen_id', $id))
			{
				//hapus semua Kegiatan yang terkait dengan dosen tersebut
				$this->Kegiatan->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Penghargaan milik dosen ini
			if($this->Penghargaan->isExist('dosen_id', $id))
			{
				//hapus semua Penghargaan yang terkait dengan dosen tersebut
				$this->Penghargaan->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Beasiswa milik dosen ini
			if($this->Beasiswa->isExist('dosen_id', $id))
			{
				//hapus semua Beasiswa yang terkait dengan dosen tersebut
				$this->Beasiswa->delete_where('dosen_id', $id);
				return FALSE;
			}
			
			// apakah ada Organisasi milik dosen ini
			if($this->Organisasi->isExist('dosen_id', $id))
			{
				//hapus semua Organisasi yang terkait dengan dosen tersebut
				$this->Organisasi->delete_where('dosen_id', $id);
				return FALSE;
			}

			
			
			

			
			
			
			// sekarang hapus dosen yang bersangkutan
			$this->Dosen->delete($id);
			redirect(ADM_URL . '/dosen/index', 'location');
		}
		else
		{
			$this->load->view('error');
		}
	}
	
	function add()
	{
		if ($this->Otoritas->isAdmin())
		{
			$data['username'] = $this->input->post('username');
			
			if ($this->Dosen->count('username', $data['username']) > 0)
			{
				// sudah ada dosen dengan nomor induk yang sama
				echo 'tidak boleh ada dosen dengan nomor induk yang sama!';
			}
			else
			{
				$data['pass'] = md5('informatika');
				
				$data['nama'] = $this->input->post('nama');
				$data['kelahiran'] = $this->input->post('kelahiran');
				$data['alamat'] = $this->input->post('alamat');
				$data['telpon'] = $this->input->post('telpon');
				$data['email'] = $this->input->post('email');
				$data['homepage'] = $this->input->post('homepage');
				
				$this->Dosen->insert($data);
				redirect(ADM_URL . '/dosen/index', 'location');
			}
		}
	}
	
	function edit($id)
	{
		if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $id) :
			$dosen = $this->Dosen->getOne($id);
			$data['dosen_id'] = $id;
			$data['username'] = $dosen->username;
			$data['nama'] = $dosen->nama;
			$data['kelahiran'] = $dosen->kelahiran;
			$data['alamat'] = $dosen->alamat;
			$data['telpon'] = $dosen->telpon;
			$data['email'] = $dosen->email;
			$data['homepage'] = $dosen->homepage;
			
			$data['karyas'] = $this->Karya->get_where('dosen_id', $id);;
			$this->load->view(ADM_URL . '/form_dosen_edit', $data);
		else :
			redirect(ADM_URL . '/manage/unauthorized', 'location');
		endif;
	}
	
	function edit_p()
	{
		$dosen_id = $this->input->post('dosen_id');
		$data['nama'] = $this->input->post('nama');
		$data['kelahiran'] = $this->input->post('kelahiran');
		$data['alamat'] = $this->input->post('alamat');
		$data['telpon'] = $this->input->post('telpon');
		$data['email'] = $this->input->post('email');
		$data['homepage'] = $this->input->post('homepage');

		$this->Dosen->update($dosen_id, $data);
		redirect(ADM_URL . '/dosen/index', 'location');
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
	
	function gravatar($cmd)
	{
		if ($cmd == 1 || $cmd == 0)
		{
			$id = $this->Otoritas->getId();
			$this->Dosen->update($id, array('gravatar' => $cmd));
			$this->session->set_userdata('foto', $this->Foto->getFoto( $this->Otoritas->getId() ));
			redirect(ADM_URL . '/profpic', 'location');
		}
	}
}