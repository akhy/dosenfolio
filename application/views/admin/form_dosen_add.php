<?php

$this->load->helper('form');

echo form_open_multipart(ADM_URL . '/dosen/add');
	echo heading('Tambahkan dosen baru', 3);

	echo form_label('Username', 'username');
	echo form_input('username');
	
	echo form_label('Nama dosen', 'nama');
	echo form_input('nama');
	
	echo form_label('Tempat/tanggal lahir', 'kelahiran');
	echo form_input('kelahiran');
	
	echo form_label('Alamat', 'alamat');
	echo form_input('alamat');
	
	echo form_label('Nomor telepon', 'telpon');
	echo form_input('telpon');
	
	echo form_label('Email', 'email');
	echo form_input('email');
	
	echo form_label('Homepage (website, blog, dll)', 'homepage');
	echo form_input('homepage');
	
	echo '<div class="info">' . 
		'<p>Tidak boleh ada lebih dari satu dosen yang memiliki nomor induk yang sama.</p>' .	
		'<p>Anda bisa memasukkan lebih dari satu email. Pisahkan dengan tanda koma (,)</p>' .	
		'<p>Anda bisa memasukkan lebih dari satu homepage. Pisahkan dengan tanda koma (,)</p>' .	
	'</div>';
		
	echo form_submit('submit', 'Tambahkan');
	
echo form_close();