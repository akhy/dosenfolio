<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/kegiatan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Nama Kegiatan Ilmiah', 'nama');
	echo form_input('nama');
	
	echo form_label('Kedudukan Peran', 'peran');
	echo form_input('peran');
	
	echo form_label('Penyelenggara', 'penyelenggara');
	echo form_input('penyelenggara');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
	
	echo form_label('Tempat', 'tempat');
	echo form_input('tempat');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();