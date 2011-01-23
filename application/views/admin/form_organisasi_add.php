<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/jabatan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Nama Organisasi', 'nama');
	echo form_input('nama');
	
	echo form_label('Posisi/Jabatan', 'posisi');
	echo form_input('posisi');
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk');
	
	echo form_label('Tahun Keluar', 'thn_keluar');
	echo form_input('thn_keluar');
	
	echo form_label('Tempat', 'tempat');
	echo form_input('tempat');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();