<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/beasiswa/edit_p');

	echo form_hidden('beasiswa_id', $beasiswa_id);
	
	echo form_label('Beasiswa', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Instansi', 'instansi');
	echo form_input('instansi', $instansi);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_submit('submit', 'Ubah');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');