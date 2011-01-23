<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/organisasi/edit_p');

	echo form_hidden('organisasi_id', $organisasi_id);
	
	echo form_label('Nama Organisasi', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Posisi/Jabatan', 'posisi');
	echo form_input('posisi', $posisi);
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk', $thn_masuk);
	
	echo form_label('Tahun Keluar', 'thn_keluar');
	echo form_input('thn_keluar', $thn_keluar);
	
	echo form_label('Tempat', 'tempat');
	echo form_input('tempat', $tempat);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');