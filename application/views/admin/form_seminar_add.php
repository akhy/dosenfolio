<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/seminar/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Judul Karya Ilmiah', 'judul');
	echo form_input('judul');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
	
	echo form_label('Nama Seminar', 'seminar');
	echo form_input('seminar');
	
	echo form_label('Jenis Seminar', 'jenis');
	echo form_dropdown('jenis', array(
		0 => '-',
		1 => 'Seminar Internasional',
		2 => 'Seminar Nasional'
	));
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();