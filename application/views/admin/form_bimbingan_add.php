<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/bimbingan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Strata', 'strata');
	echo form_dropdown('strata', array(
		'D1' => 'D1',
		'D2' => 'D2',
		'D3' => 'D3',
		'S1' => 'S1',
		'S2' => 'S2',
		'S3' => 'S3'
	));
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
	
	echo form_label('Jumlah Mahasiswa', 'jumlah');
	echo form_input('jumlah');
	
	echo form_label('Program Studi', 'prodi');
	echo form_input('prodi');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();