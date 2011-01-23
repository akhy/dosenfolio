<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/pendidikan/edit_p');

	echo form_hidden('pendidikan_id', $pendidikan_id);
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi', $institusi);
	
	echo form_label('Program Studi', 'prodi');
	echo form_input('prodi', $prodi);
	
	echo form_label('Jurusan', 'jurusan');
	echo form_input('jurusan', $jurusan);	
	
	echo form_label('Tahun Masuk', 'thn_masuk');
	echo form_input('thn_masuk', $thn_masuk);
	
	echo form_label('Tahun Lulus (opsional)', 'thn_lulus');
	echo form_input('thn_lulus', $thn_lulus);
		
	echo form_label('Derajat', 'derajat');
	echo form_input('derajat', $derajat);
	
	echo form_submit('submit', 'Ubah');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');