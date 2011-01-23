<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/makul/edit_p');

	echo form_hidden('makul_id', $makul_id);
	
	echo form_label('Mata Kuliah', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Semester', 'semester');
	echo form_dropdown('semester', array('0' => '-', '1' => 'Ganjil', '2' => 'Genap'), $semester);
	
	echo form_label('Tahun Akademik', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');