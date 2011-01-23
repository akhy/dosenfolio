<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/jabatan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Jabatan', 'nama');
	echo form_input('nama');
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi');
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk');
	
	echo form_label('Tahun Keluar', 'thn_keluar');
	echo form_input('thn_keluar');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();