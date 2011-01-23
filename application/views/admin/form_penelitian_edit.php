<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/penelitian/edit_p');

	echo form_hidden('penelitian_id', $penelitian_id);
	
	echo form_label('Judul Penelitian', 'judul');
	echo form_input('judul', $judul);
	
	echo form_label('Waktu mulai', 'wkt_start');
	echo form_input('wkt_start', $wkt_start);
	
	echo form_label('Waktu selesai', 'wkt_end');
	echo form_input('wkt_end', $wkt_end);
	
	echo form_label('Posisi dalam tim', 'posisi');
	echo form_input('posisi', $posisi);
		
	echo form_label('Sumber dana', 'sumber');
	echo form_input('sumber', $sumber);
	
	echo form_label('Besarnya dana', 'dana');
	echo form_input('dana', $dana);
	
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');