<?php

$this->load->helper('form');

echo form_open(ADM_URL . '/kategori/add');
echo form_label('Nama kategori portofolio', 'nama_kat');
echo form_input('nama_kat');
echo form_submit('submit', 'Tambahkan');
echo form_close();