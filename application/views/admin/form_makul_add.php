<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/makul/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Mata Kuliah', 'nama');
	echo form_input('nama');
	
	echo form_label('Semester', 'semester');
	echo form_dropdown('semester', array('0' => '-', '1' => 'Ganjil', '2' => 'Genap'));
	
	echo form_label('Tahun Akademik', 'tahun');
	echo form_input('tahun');
	

		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();