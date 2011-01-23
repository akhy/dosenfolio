<?php
$this->load->view(ADM_URL . '/tpl_header.php');
foreach($kat as $k)
{
	$options[$k->kategori_id] = $k->nama_kat;
}

$this->load->helper('form');

echo form_open(ADM_URL . '/karya/edit_p');

	echo form_hidden('karya_id', $karya_id);
	
	echo form_label('Judul', 'judul');
	echo form_input('judul', $judul);
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun', $tahun);
	
	echo form_label('Kategori', 'kategori_id');
	echo form_dropdown('kategori_id', $options, $kategori_id);
	
	echo form_label('Deskripsi', 'deskripsi');
	echo form_textarea('deskripsi', $deskripsi);
	
	echo form_submit('submit', 'Ubah');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');