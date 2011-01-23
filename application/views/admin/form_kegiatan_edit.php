<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/kegiatan/edit_p');

	echo form_hidden('kegiatan_id', $kegiatan_id);
	
	echo form_label('Nama Kegiatan Ilmiah', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Kedudukan Peran', 'peran');
	echo form_input('peran', $peran);
	
	echo form_label('Penyelenggara', 'penyelenggara');
	echo form_input('penyelenggara', $penyelenggara);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Tempat', 'tempat');
	echo form_input('tempat', $tempat);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');