<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/penghargaan/add');

	echo form_hidden('dosen_id', $dosen_id);
	
	echo form_label('Penghargaan', 'nama');
	echo form_input('nama');
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();