<?php
$id = $dosen->dosen_id;

if ($this->Otoritas->isDosen())
{
	echo '<div class="entity">'; 
	
	// data dosen 
	echo img(array(
		'src' => $this->Foto->getFoto($id),
		'class' => 'big avatar',
		'alt' => 'Foto'
	)); 
	
	echo  '<h1>' . $dosen->nama . ' <span class="gray smaller">(' . $dosen->username . ')</span></h1>';
}
if ($this->Otoritas->isAdmin())
{
	echo  '<h3>' . $dosen->nama . ' <span class="gray smaller">(' . $dosen->username . ')</span>';
	echo anchor(ADM_URL . '/dosen/edit/' . $dosen->dosen_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)'))) . ' '; 
	echo anchor(ADM_URL . '/dosen/delete/' . $dosen->dosen_id, img(
			array('src' => 'images/crud_delete.png', 'alt' => '(hapus)',
				'onclick' => 'return confirm(\'Yakin akan menghapus dosen ini?\')'
			)
		));
	
	echo '</h3>';
}
//---------------------------------------------------------------------------------------------

if (! $this->Otoritas->isAdmin())
{
	// list biografi
	
	// siapin email
	$this->load->helper('email');
	$emails = getMails($dosen->email);
	
	// siapin homepage
	$homepages = getHomepages($dosen->homepage);
	
	echo '<div class="data">';
	$this->table->clear();
	$this->table->add_row('Tempat, tanggal lahir', ':', $dosen->kelahiran);
	$this->table->add_row('Alamat', ':', $dosen->alamat);
	$this->table->add_row('Nomor telpon', ':', $dosen->telpon);
	$this->table->add_row('Email', ':', $emails);
	$this->table->add_row('Homepage', ':', $homepages);
	
	echo $this->table->generate(); 
	echo '</div>';
	
	/*
	echo '<h2 id="biografi">' . 'BIOGRAFI' . '</h2>';
	$this->load->helper('typography');
	echo '<blockquote>' . auto_typography($dosen->biografi) . '</blockquote>';
	*/
		echo anchor(ADM_URL . '/dosen/edit/' . $dosen->dosen_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)'))) . ' '; 
	//---------------------------------------------------------------------------------------------
	
	
	// setting table
	$tmpl = array ( 'table_open'  => '<table border="0" cellspacing="0" class="my">' );
	$this->table->set_template($tmpl); 
	$this->table->set_empty('-');
	
	
	
	// list pendidikan
	echo '<h2 id="pendidikan">' . 'PENDIDIKAN' . '</h2>';
	if ($this->Pendidikan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$pendidikans = $this->Pendidikan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
		
		$this->table->clear();
		$this->table->set_heading('Tingkat', 'Program Studi', 'Jurusan', 'Tahun', 'Tempat', '');
		foreach($pendidikans as $pend)
		{
			if ($pend->thn_masuk == $pend->thn_lulus || $pend->thn_lulus == '0000') 
				$tahun = $pend->thn_masuk;
			else if ($pend->thn_masuk == '0000' && $pend->thn_lulus != '0000')
				$tahun = 'Lulus ' . $pend->thn_lulus;
			else
				$tahun = $pend->thn_masuk . ' - ' . $pend->thn_lulus;
				
				
			$crud_link = 
				anchor(ADM_URL . '/pendidikan/delete/' . $pend->pendidikan_id, img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/pendidikan/edit/' . $pend->pendidikan_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))); 
			
			$this->table->add_row($pend->derajat, $pend->prodi, $pend->jurusan, $tahun, $pend->institusi, $crud_link);
			
		}
		echo $this->table->generate();
	}
	else
	{
		echo '<div class="info">' . "Belum ada riwayat pendidikan ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"pendidikan"' . ", $id)' >Tambahkan</span>";
	echo "<div id='pendidikan_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_pendidikan_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------
	
	
	
	// list jabatan
	echo '<h2 id="jabatan">' . 'Jabatan Struktural' . '</h2>';
	if ($this->Jabatan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$jabatans = $this->Jabatan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
				
		$this->table->clear();
		$this->table->set_heading('Jabatan Struktural', 'Tahun', 'Instansi', '');
		foreach($jabatans as $jabatan)
		{
			if ($jabatan->thn_masuk == $jabatan->thn_keluar) 
				$tahun = $jabatan->thn_masuk;
			else if($jabatan->thn_keluar == '0000')
				$tahun = $jabatan->thn_masuk . ' - sekarang';
			else
				$tahun = $jabatan->thn_masuk . ' - ' . $jabatan->thn_keluar;
						
			$crud_link = anchor(ADM_URL . '/jabatan/delete/' . $jabatan->jabatan_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/jabatan/edit/' . $jabatan->jabatan_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($jabatan->nama, $tahun, $jabatan->institusi, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada jabatan ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"jabatan"' . ", $id)' >Tambahkan</span>";
	echo "<div id='jabatan_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_jabatan_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	// list pengajaran (makul)
	echo '<h2 id="makul">' . 'Pengajaran' . '</h2>';
	if ($this->Makul->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$makuls = $this->Makul->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Mata Kuliah', 'Semester', 'Tahun Akademik', '');
		foreach($makuls as $makul)
		{
			$semester = ($makul->semester % 2 == 0) ? 'Genap' : 'Ganjil';
			$semester = ($makul->semester == 0) ? '-' : $semester;
			$crud_link = anchor(ADM_URL . '/makul/delete/' . $makul->makul_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/makul/edit/' . $makul->makul_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($makul->nama, $semester, $makul->tahun, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada pengajaran mata kuliah ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"makul"' . ", $id)' >Tambahkan</span>";
	echo "<div id='makul_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_makul_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------


	// list buku
	echo '<h2 id="buku">' . 'Penulisan buku dan handout' . '</h2>';
	if ($this->Buku->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$bukus = $this->Buku->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Judul', 'Jenis', 'Tahun', 'Penerbit', '');
		foreach($bukus as $buku)
		{
			$crud_link = anchor(ADM_URL . '/buku/delete/' . $buku->buku_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/buku/edit/' . $buku->buku_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($buku->judul, $buku->jenis, $buku->tahun, $buku->penerbit, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada penulisan buku/handout ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"buku"' . ", $id)' >Tambahkan</span>";
	echo "<div id='buku_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_buku_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	// list bimbingan
	echo '<h2 id="bimbingan">' . 'Mahasiswa Bimbingan' . '</h2>';
	if ($this->Bimbingan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$bimbingans = $this->Bimbingan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Strata', 'Tahun', 'Jumlah Mahasiswa', 'Program Studi', '');
		foreach($bimbingans as $bimbingan)
		{
			$crud_link = anchor(ADM_URL . '/bimbingan/delete/' . $bimbingan->bimbingan_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/bimbingan/edit/' . $bimbingan->bimbingan_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($bimbingan->strata, $bimbingan->tahun, $bimbingan->jumlah, $bimbingan->prodi, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada bimbingan ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"bimbingan"' . ", $id)' >Tambahkan</span>";
	echo "<div id='bimbingan_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_bimbingan_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------
	
	// list publikasi
	echo '<h2 id="publikasi">' . 'Publikasi di Jurnal Ilmiah' . '</h2>';
	if ($this->Publikasi->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$publikasis = $this->Publikasi->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Judul Penelitian', 'Tahun', 'Posisi Penulis', 'Jurnal', 'Jenis', '');
		foreach($publikasis as $publikasi)
		{
			$jenis = '-';			
			$jenis = ($publikasi->jenis % 3 == 1) ? 'Jurnal Ilmiah Internasional' : $jenis;
			$jenis = ($publikasi->jenis % 3 == 2) ? 'Jurnal Ilmiah Terakreditasi' : $jenis;
			$jenis = ($publikasi->jenis % 3 == 0) ? 'Jurnal Ilmiah Tak Terakreditasi' : $jenis;
			$jenis = ($publikasi->jenis == 0) ? '-' : $jenis;
			
			$crud_link = anchor(ADM_URL . '/publikasi/delete/' . $publikasi->publikasi_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/publikasi/edit/' . $publikasi->publikasi_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($publikasi->judul, $publikasi->tahun, $publikasi->posisi, $publikasi->media, $jenis, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada publikasi di jurnal ilmiah ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"publikasi"' . ", $id)' >Tambahkan</span>";
	echo "<div id='publikasi_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_publikasi_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------


	// list seminar
	echo '<h2 id="seminar">' . 'Karya Ilmiah di Seminar' . '</h2>';
	if ($this->Seminar->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$seminars = $this->Seminar->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Judul Karya Ilmiah', 'Tahun', 'Seminar', 'Jenis', '');
		foreach($seminars as $seminar)
		{
			$jenis = '-';			
			$jenis = ($seminar->jenis % 2 == 1) ? 'Seminar Internasional' : $jenis;
			$jenis = ($seminar->jenis % 2 == 0) ? 'Seminar Nasional' : $jenis;
			$jenis = ($seminar->jenis == 0) ? '-' : $jenis;
			
			$crud_link = anchor(ADM_URL . '/seminar/delete/' . $seminar->seminar_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/seminar/edit/' . $seminar->seminar_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($seminar->judul, $seminar->tahun, $seminar->seminar, $jenis, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada karya ilmiah di seminar ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"seminar"' . ", $id)' >Tambahkan</span>";
	echo "<div id='seminar_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_seminar_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	// list kegiatan
	echo '<h2 id="kegiatan">' . 'Kegiatan Ilmiah' . '</h2>';
	if ($this->Kegiatan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$kegiatans = $this->Kegiatan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
				
		$this->table->clear();
		$this->table->set_heading('Nama Kegiatan', 'Peranan', 'Penyelenggara', 'Tahun', 'Tempat', '');
		foreach($kegiatans as $kegiatan)
		{
			$crud_link = anchor(ADM_URL . '/kegiatan/delete/' . $kegiatan->kegiatan_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/kegiatan/edit/' . $kegiatan->kegiatan_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($kegiatan->nama, $kegiatan->peran, $kegiatan->penyelenggara, $kegiatan->tahun, $kegiatan->tempat, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada kegiatan ilmiah ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"kegiatan"' . ", $id)' >Tambahkan</span>";
	echo "<div id='kegiatan_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_kegiatan_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	// list penelitian
	echo '<h2 id="penelitian">' . 'Penelitian' . '</h2>';
	if ($this->Penelitian->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$penelitians = $this->Penelitian->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'wkt_start');
				
		$this->table->clear();
		$this->table->set_heading('Judul penelitian', 'Waktu', 'Posisi', 'Sumber dana', 'Besarnya dana', '');
		foreach($penelitians as $penelitian)
		{
			$waktu = ($penelitian->wkt_end == '') ? $penelitian->wkt_start : $penelitian->wkt_start . ' - ' . $penelitian->wkt_end;
			$crud_link = anchor(ADM_URL . '/penelitian/delete/' . $penelitian->penelitian_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/penelitian/edit/' . $penelitian->penelitian_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($penelitian->judul, $waktu, $penelitian->posisi, $penelitian->sumber, $penelitian->dana, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada penelitian ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"penelitian"' . ", $id)' >Tambahkan</span>";
	echo "<div id='penelitian_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_penelitian_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	
	// list penghargaan
	echo '<h2 id="penghargaan">' . 'Penghargaan' . '</h2>';
	if ($this->Penghargaan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$penghargaans = $this->Penghargaan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		echo '<ul>';
		foreach($penghargaans as $peng)
		{
				
			echo '<li>' . $peng->tahun . ' | ' . $peng->nama . ' ' .
				' (' . $peng->institusi . ') ' .
				anchor(ADM_URL . '/penghargaan/delete/' . $peng->penghargaan_id, img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/penghargaan/edit/' . $peng->penghargaan_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' ' .
			'</li>'; 
		}
		echo '</ul>';
	}
	else
	{
		echo '<div class="info">' . "Belum ada penghargaan ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"penghargaan"' . ", $id)' >Tambahkan</span>";
	echo "<div id='penghargaan_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_penghargaan_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------
	
	// list beasiswa
	echo '<h2 id="beasiswa">' . 'Beasiswa yang diperoleh' . '</h2>';
	if ($this->Beasiswa->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$beasiswas = $this->Beasiswa->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		echo '<ul>';
		foreach($beasiswas as $bea)
		{
				
			echo '<li>' . $bea->tahun . ' | ' . $bea->nama . ' ' .
				' (' . $bea->instansi . ') ' .
				anchor(ADM_URL . '/beasiswa/delete/' . $bea->beasiswa_id, img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/beasiswa/edit/' . $bea->beasiswa_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' ' .
			'</li>'; 
		}
		echo '</ul>';
	}
	else
	{
		echo '<div class="info">' . "Belum ada beasiswa ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"beasiswa"' . ", $id)' >Tambahkan</span>";
	echo "<div id='beasiswa_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_beasiswa_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------
	
	// list organisasi
	echo '<h2 id="organisasi">' . 'Organisasi' . '</h2>';
	if ($this->Organisasi->count('dosen_id', $dosen->dosen_id) > 0)
	{
		$organisasis = $this->Organisasi->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
				
		$this->table->clear();
		$this->table->set_heading('Nama organisasi', 'Kedudukan di organisasi', 'Tahun', 'Tempat', '');
		foreach($organisasis as $organisasi)
		{
			if ($organisasi->thn_masuk == $organisasi->thn_keluar || $organisasi->thn_keluar == '0000') 
				$tahun = $organisasi->thn_masuk;
			else
				$tahun = $organisasi->thn_masuk . ' - ' . $organisasi->thn_keluar;
				
			$crud_link = anchor(ADM_URL . '/organisasi/delete/' . $organisasi->organisasi_id, 
				img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud', 
				'onclick' => 'return confirm(\'Yakin akan menghapus data ini?\')'))) . ' ' .
				anchor(ADM_URL . '/organisasi/edit/' . $organisasi->organisasi_id, 
				img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' '; 
			
			$this->table->add_row($organisasi->nama, $organisasi->posisi, $tahun, $organisasi->tempat, $crud_link);
		}
		echo $this->table->generate(); 
	}
	else
	{
		echo '<div class="info">' . "Belum ada organisasi ditambahkan" . '</div>';
	}
	echo "<span class='button gray' onclick='show(" . '"organisasi"' . ", $id)' >Tambahkan</span>";
	echo "<div id='organisasi_$id' class='form'>";
	$this->load->view(ADM_URL . '/form_organisasi_add', $data);
	echo '</div>';
	//---------------------------------------------------------------------------------------------

	
	
	

	//---------------------------------------------------------------------------------------------
	
	
	echo '</div>';
}

