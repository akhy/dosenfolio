<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/buku/edit_p');

	echo form_hidden('buku_id', $buku_id);
	
	echo form_label('Judul', 'judul');
	echo form_input('judul', $judul);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Jenis', 'jenis');
	echo form_dropdown('jenis', array(
		'Buku' => 'Buku', 
		'Handout' => 'Handout',
		'Modul Praktikum' => 'Modul Praktikum',
		'Diktat' => 'Diktat'
	), $jenis);
	
	echo form_label('Penerbit', 'penerbit');
	echo form_input('penerbit', $penerbit);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');