<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/bimbingan/edit_p');

	echo form_hidden('bimbingan_id', $bimbingan_id);
	
	echo form_label('Strata', 'strata');
	echo form_dropdown('strata', array(
		'D1' => 'D1',
		'D2' => 'D2',
		'D3' => 'D3',
		'S1' => 'S1',
		'S2' => 'S2',
		'S3' => 'S3'
	), $strata);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Jumlah Mahasiswa', 'jumlah');
	echo form_input('jumlah', $jumlah);
	
	echo form_label('Program Studi', 'prodi');
	echo form_input('prodi', $prodi);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');