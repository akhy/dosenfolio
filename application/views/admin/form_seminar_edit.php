<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/seminar/edit_p');

	echo form_hidden('seminar_id', $seminar_id);
	
	echo form_label('Judul Karya Ilmiah', 'judul');
	echo form_input('judul', $judul);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Nama Seminar', 'seminar');
	echo form_input('seminar', $seminar);
	
	echo form_label('Jenis Seminar', 'jenis');
	echo form_dropdown('jenis', array(
		0 => '-',
		1 => 'Seminar Internasional',
		2 => 'Seminar Nasional'
	), $jenis);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');