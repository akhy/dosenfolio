<?php 

$this->load->view('tpl_header', array('active' => 'staff', 'subtitle' => $dosen->nama)); 
?>
<div id="content">
<?php 
	$download_link = anchor('staff/printable/' . url_title($dosen->nama, 'dash', TRUE) . '-' . $dosen->dosen_id, 
	'Printer friendly version',
	array('class' => 'pdf')
	);
	$edit_link = anchor(ADM_URL . '/dosen/edit/' . $dosen->dosen_id, 'Edit Profile', array('class' => 'edit')); 
	$back_link = anchor('staff/all', 'Back to staffs list', array('class' => 'back') );
	
	// nama
	echo  '<h1>' . $dosen->nama . '</h1>';
	
	// links
	echo '<div id="links">';
	echo $download_link . ' ';
	if ($this->Otoritas->isAdmin() || $this->Otoritas->getId() == $dosen->dosen_id)
		echo $edit_link . ' ';
	echo $back_link;
	echo '</div>';

	// list biografi
	$this->load->helper('email');
	$emails = getMails($dosen->email);

	$homepages = getHomepages($dosen->homepage);
	
	echo '<div class="data">';
	$this->table->clear();
	if ($dosen->kelahiran != '')
		$this->table->add_row('Date of birth', ':', $dosen->kelahiran);
	if ($dosen->alamat != '')
		$this->table->add_row('Address', ':', $dosen->alamat);
	if ($dosen->telpon != '')
		$this->table->add_row('Phone number', ':', $dosen->telpon);
	if ($dosen->email != '')
		$this->table->add_row('Email address', ':', $emails);
	if ($dosen->homepage != '')
		$this->table->add_row('Homepage', ':', $homepages);
	
	$foto_url = $this->Foto->getFoto($dosen->dosen_id);
	echo img(array('src' => $foto_url,
		'class' => 'big avatar',
		'alt' => 'Foto'
	)); 
	echo $this->table->generate(); 
	echo clear();
	echo '</div>';
	
	
	/*
	echo '<h2 id="biografi">' . 'BIOGRAPHY' . '</h2>';
	
	if ($dosen->biografi != '')
		echo '<blockquote>' . auto_typography($dosen->biografi) . '</blockquote>';
	*/
	
	$tmpl = array ( 'table_open'  => '<table border="0" cellspacing="0" class="my">' );
	$this->table->set_template($tmpl); 
	$this->table->set_empty('-');
	
	// list pendidikan
	if ($this->Pendidikan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="pendidikan">' . 'Riwayat Pendidikan' . '</h2>';
		$pendidikans = $this->Pendidikan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
		
		$this->table->clear();
		$this->table->set_heading('Tahun', 'Tingkat', 'Tempat', 'Program Studi', 'Jurusan');
		foreach($pendidikans as $pend)
		{
			if ($pend->thn_masuk == $pend->thn_lulus || $pend->thn_lulus == '0000') 
				$tahun = $pend->thn_masuk;
			else
				$tahun = $pend->thn_masuk . ' - ' . $pend->thn_lulus;
			
			$this->table->add_row($tahun, $pend->derajat, 
				$pend->institusi, $pend->prodi, $pend->jurusan );
		}
		echo $this->table->generate(); 
	}

	// list jabatan
	if ($this->Jabatan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="jabatan">' . 'Jabatan Struktural' . '</h2>';
		$jabatans = $this->Jabatan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
		
		$this->table->clear();
		$this->table->set_heading('Jabatan Struktural', 'Tahun', 'Instansi');
		foreach($jabatans as $jabatan)
		{
			if ($jabatan->thn_masuk == $jabatan->thn_keluar || $jabatan->thn_keluar == '0000') 
				$tahun = $jabatan->thn_masuk;
			else
				$tahun = $jabatan->thn_masuk . ' - ' . $jabatan->thn_keluar;
				
			$this->table->add_row($jabatan->nama, $tahun, $jabatan->institusi);
		}
		echo $this->table->generate(); 
	}
	
	// list mata kuliah
	if ($this->Makul->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="makul">' . 'Pengajaran' . '</h2>';
		$makuls = $this->Makul->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Mata Kuliah', 'Semester', 'Tahun Akademik');
		foreach($makuls as $makul)
		{
			$semester = ($makul->semester % 2 == 0) ? 'Genap' : 'Ganjil';
			$semester = ($makul->semester == 0) ? '-' : $semester;
			$this->table->add_row($makul->nama, $semester, $makul->tahun);
		}
		echo $this->table->generate(); 
	}
	
	// list buku
	if ($this->Buku->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="buku">' . 'Penulisan Buku dan Handout' . '</h2>';
		$bukus = $this->Buku->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Judul', 'Jenis', 'Tahun', 'Penerbit');
		foreach($bukus as $buku)
		{
			$this->table->add_row($buku->judul, $buku->jenis, $buku->tahun, $buku->penerbit);
		}
		echo $this->table->generate(); 
	}
	
	// list bimbingan
	if ($this->Bimbingan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="bimbingan">' . 'Mahasiswa Bimbingan' . '</h2>';
		$bimbingans = $this->Bimbingan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Strata', 'Tahun', 'Jumlah', 'Program Studi');
		foreach($bimbingans as $bimbingan)
		{
			$this->table->add_row($bimbingan->strata, $bimbingan->tahun, $bimbingan->jumlah . ' mahasiswa', $bimbingan->prodi);
		}
		echo $this->table->generate(); 
	}
	
	// list publikasi
	if ($this->Publikasi->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="publikasi">' . 'Publikasi Penelitian' . '</h2>';
		$publikasis = $this->Publikasi->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Judul Penelitian', 'Tahun', 'Posisi Penulis', 'Jurnal', 'Jenis');
		foreach($publikasis as $publikasi)
		{
			$jenis = '-';			
			$jenis = ($publikasi->jenis % 3 == 1) ? 'Jurnal Ilmiah Internasional' : $jenis;
			$jenis = ($publikasi->jenis % 3 == 2) ? 'Jurnal Ilmiah Terakreditasi' : $jenis;
			$jenis = ($publikasi->jenis % 3 == 0) ? 'Jurnal Ilmiah Tak Terakreditasi' : $jenis;
			$jenis = ($publikasi->jenis == 0) ? '-' : $jenis;
			
			$this->table->add_row($publikasi->judul, $publikasi->tahun, $publikasi->posisi, $publikasi->media, $jenis);
		}
		echo $this->table->generate(); 
	}
	
	// list seminar
	if ($this->Seminar->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="seminar">' . 'Karya Ilmiah' . '</h2>';
		$seminars = $this->Seminar->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Judul Karya Ilmiah', 'Tahun', 'Seminar', 'Jenis');
		foreach($seminars as $seminar)
		{
			$jenis = '-';
			$jenis = ($seminar->jenis % 2 == 1) ? 'Seminar Internasional' : $jenis;
			$jenis = ($seminar->jenis % 2 == 0) ? 'Seminar Nasional' : $jenis;
			$jenis = ($seminar->jenis == 0) ? '-' : $jenis;
			
			$this->table->add_row($seminar->judul, $seminar->tahun, $seminar->seminar, $jenis);
		}
		echo $this->table->generate(); 
	}
	
	// list kegiatan ilmiah
	if ($this->Kegiatan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="kegiatan">' . 'Kegiatan Ilmiah' . '</h2>';
		$kegiatans = $this->Kegiatan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE);
		
		$this->table->clear();
		$this->table->set_heading('Nama Kegiatan', 'Kedudukan/Peranan', 'Penyelenggara','Tahun', 'Tempat');
		foreach($kegiatans as $kegiatan)
		{
			$this->table->add_row($kegiatan->nama, $kegiatan->peran, $kegiatan->penyelenggara, $kegiatan->tahun, $kegiatan->tempat);
		}
		echo $this->table->generate(); 
	}	
	
	// list penelitian
	if ($this->Penelitian->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="penelitian">' . 'Penelitian' . '</h2>';
		$penelitians = $this->Penelitian->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE);
		
		$this->table->clear();
		$this->table->set_heading('Judul Penelitian', 'Waktu', 'Posisi dalam tim','Sumber dana', 'Besar dana');
		foreach($penelitians as $penelitian)
		{
			$start = $penelitian->wkt_start;
			$end = $penelitian->wkt_end;
			$waktu = ($start == '' || $end == '') ? $start . $end : $start . ' - ' . $end;
			$this->table->add_row($penelitian->judul, $waktu, $penelitian->posisi, $penelitian->sumber, $penelitian->dana);
		}
		echo $this->table->generate(); 
	}	
	
	// list penghargaan
	
	if ($this->Penghargaan->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="penghargaan">' . 'Penghargaan' . '</h2>';
		$penghargaans = $this->Penghargaan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Penghargaan', 'Tahun', 'Instansi');
		foreach($penghargaans as $peng)
		{
			$this->table->add_row($peng->nama, $peng->tahun, $peng->institusi);	
		}
		echo $this->table->generate(); 
	}

	// list beasiswa	
	if ($this->Beasiswa->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="beasiswa">' . 'Beasiswa' . '</h2>';
		$beasiswas = $this->Beasiswa->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
		
		$this->table->clear();
		$this->table->set_heading('Beasiswa', 'Tahun', 'Instansi');
		foreach($beasiswas as $bea)
		{
			$this->table->add_row($bea->nama, $bea->tahun, $bea->instansi);	
		}
		echo $this->table->generate(); 
	}
	
	// list organisasi	
	if ($this->Organisasi->count('dosen_id', $dosen->dosen_id) > 0)
	{
		echo '<h2 id="organisasi">' . 'Organisasi' . '</h2>';
		$organisasis = $this->Organisasi->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
		
		$this->table->clear();
		$this->table->set_heading('Nama organisasi', 'Kedudukan dalam organisasi', 'Tahun', 'Tempat');
		foreach($organisasis as $org)
		{
			if ($org->thn_masuk == $org->thn_keluar || $org->thn_keluar == '0000') 
				$tahun = $org->thn_masuk;
			else
				$tahun = $org->thn_masuk . ' - ' . $org->thn_keluar;
				
			$this->table->add_row($org->nama, $org->posisi, $tahun, $org->tempat);	
		}
		echo $this->table->generate(); 
	}

	
	

	
?>	



</div>
<?php $this->load->view('tpl_footer') ?>