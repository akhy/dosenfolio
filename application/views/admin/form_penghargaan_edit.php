<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/penghargaan/edit_p');

	echo form_hidden('penghargaan_id', $penghargaan_id);
	
	echo form_label('Penghargaan', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Institusi', 'institusi');
	echo form_input('institusi', $institusi);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_submit('submit', 'Ubah');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');