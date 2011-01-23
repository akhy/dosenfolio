<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/jabatan/edit_p');

	echo form_hidden('jabatan_id', $jabatan_id);
	
	echo form_label('Jabatan', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi', $institusi);
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk', $thn_masuk);
	
	echo form_label('Tahun Keluar', 'thn_keluar');
	echo form_input('thn_keluar', $thn_keluar);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');