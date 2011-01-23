<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/beasiswa/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Beasiswa', 'nama');
	echo form_input('nama');
	
	echo form_label('Instansi', 'instansi');
	echo form_input('instansi');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();