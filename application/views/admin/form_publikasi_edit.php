<?php

$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/publikasi/edit_p');

	echo form_hidden('publikasi_id', $publikasi_id);
	
	echo form_label('Judul Penelitian', 'judul');
	echo form_input('judul', $judul);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Posisi Penulis', 'posisi');
	echo form_input('posisi', $posisi);
	
	echo form_label('Jurnal', 'media');
	echo form_input('media', $media);
	
	echo form_label('Jenis Jurnal', 'jenis');
	echo form_dropdown('jenis', array(
		0 => '-',
		1 => 'Jurnal Ilmiah Internasional',
		2 => 'Jurnal Ilmiah Terakreditasi',
		3 => 'Jurnal Ilmiah Tak Terakreditasi'
	), $jenis);
	
	echo form_submit('submit', 'Edit');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');