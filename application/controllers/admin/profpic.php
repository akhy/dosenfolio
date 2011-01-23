<?php

class Profpic extends Controller {

	function Profpic()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen');
		$this->load->model('Foto');
		$this->Dosen->initialize('dosen');
		$this->load->helper('form');
	}
	
	function index()
	{
		$this->load->view(ADM_URL . '/tpl_header');
		if ($this->Otoritas->isDosen())
		{	
			$dosen_id = $this->Otoritas->getId();
			$username = $this->Otoritas->getNoInduk();
			$dos = $this->Dosen->getOne_where('username', $username);
			$foto = $dos->foto;
			$isGravatar = $dos->gravatar;
			
			$isDefault = ($foto == 'default.jpg') ? TRUE : FALSE ;
			
			// untuk dipass ke view
			$data = array(
				'error' => '', 
				'username' => $username,
				'default' => $isDefault,
				'foto' => $this->Foto->getFoto($dosen_id),
				'isGravatar' => $isGravatar
			);
			
			// konfigurasi upload file
			$config['upload_path'] = FOTO_URL;
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_size']	= '200';
			$config['max_width']  = '1024';
			$config['max_height']  = '1024';
			$this->load->library('upload', $config);
			
			// upload
			if ( $this->input->get_post('ispost') != FALSE)
			{
				if ( ! $this->upload->do_upload())
				{
					$data['error'] = $this->upload->display_errors();
				}	
				else
				{
					$upload_data = $this->upload->data();
					$file_path = $upload_data['file_path'];
					$file_name = $upload_data['file_name'];
					$file_ext = $upload_data['file_ext'];
					$new_filename = $username . $file_ext;
					
					// hapus dulu bila sudah ada
					if (file_exists($file_path . $foto) && $foto != 'default.jpg')
						unlink($file_path . $foto);
					
					// rename sesuai nomor induk
					rename($file_path . $file_name, $file_path . $new_filename);
					
					// update db
					$this->Dosen->update($dosen_id, array('foto' => $new_filename));
					
					// update session
					$this->session->set_userdata('foto', $this->Foto->getFoto($dosen_id));
					
					// resize foto
					$config['image_library'] = 'gd2';
					$config['source_image'] = FOTO_URL . $new_filename;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 150;
					$config['height'] = 150;
					
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					redirect(ADM_URL . '/profpic/index', 'location');
				}
			}
			$this->load->view(ADM_URL . '/upload_form', $data);
		}
	}
	function delete()
	{
		$dosen_id = $this->Otoritas->getId();
		$dos = $this->Dosen->getOne_where('dosen_id', $dosen_id);
		$foto = $dos->foto;
		
		if (file_exists(FOTO_URL . $foto) && $foto != 'default.jpg')
			unlink(FOTO_URL . $foto);
					
		$this->Dosen->update($dosen_id, array('foto' => 'default.jpg'));
		
		$this->session->set_userdata('foto', $this->Foto->getFoto($dosen_id));
		redirect(ADM_URL . '/profpic/index', 'location');
	}
}
	
