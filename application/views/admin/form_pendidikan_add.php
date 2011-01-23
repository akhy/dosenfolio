<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/pendidikan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi');
	
	echo form_label('Prodi', 'prodi');
	echo form_input('prodi');
	
	echo form_label('Jurusan', 'jurusan');
	echo form_input('jurusan');
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk');
	
	echo form_label('Tahun Lulus', 'thn_lulus');
	echo form_input('thn_lulus');
		
	echo form_label('Derajat', 'derajat');
	echo form_input('derajat');
	
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();