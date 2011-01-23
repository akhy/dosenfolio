<?php
$this->load->view(ADM_URL . '/tpl_header.php');
$this->load->helper('form');

echo form_open(ADM_URL . '/kategori/edit_p');
echo form_label('Nama Kategori', 'nama_kat');
echo form_input('nama_kat', $nama_kat);
echo form_hidden('kategori_id', $kategori_id);
echo form_submit('submit', 'Ubah');
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');