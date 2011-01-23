<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/penelitian/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Judul Penelitian', 'judul');
	echo form_input('judul');
	
	echo form_label('Waktu mulai', 'wkt_start');
	echo form_input('wkt_start');
	
	echo form_label('Waktu selesai', 'wkt_end');
	echo form_input('wkt_end');
	
	echo form_label('Posisi dalam tim', 'posisi');
	echo form_input('posisi');
		
	echo form_label('Sumber dana', 'sumber');
	echo form_input('sumber');
	
	echo form_label('Besarnya dana', 'dana');
	echo form_input('dana');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();