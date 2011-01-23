<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/buku/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Judul', 'judul');
	echo form_input('judul');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
	
	echo form_label('Jenis', 'jenis');
	echo form_dropdown('jenis', array(
		'Buku' => 'Buku', 
		'Handout' => 'Handout',
		'Modul Praktikum' => 'Modul Praktikum',
		'Diktat' => 'Diktat'
	));
	
	echo form_label('Penerbit', 'penerbit');
	echo form_input('penerbit');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();