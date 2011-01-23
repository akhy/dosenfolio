<?php
$this->load->view(ADM_URL . '/tpl_header.php');

$this->load->helper('form');

echo form_open(ADM_URL . '/dosen/edit_p');

	echo form_hidden('dosen_id', $dosen_id);
	echo form_hidden('username', $username);
	
	echo form_label('Nama', 'nama');
	echo form_input('nama', $nama);
	
	echo form_label('Tempat/tanggal lahir', 'kelahiran');
	echo form_input('kelahiran', $kelahiran);
	
	echo form_label('Alamat', 'alamat');
	echo form_input('alamat', $alamat);
	
	echo form_label('Nomor telepon', 'telpon');
	echo form_input('telpon', $telpon);
	
	echo form_label('Email', 'email');
	echo form_input('email', $email);
	
	echo form_label('Homepage (website, blog, dll)', 'homepage');
	echo form_input('homepage', $homepage);
	

	
	echo '<div class="info">' . 
		'<p>Anda bisa memasukkan lebih dari satu email. Pisahkan dengan tanda koma (,)</p>' .	
		'<p>Email akan ditampilkan pada halaman portofolio menggunakan JavaScript sehingga aman dari spammer.</p>' .
		'<p>Anda bisa memasukkan lebih dari satu homepage. Pisahkan dengan tanda koma (,)</p>' .	
	'</div>';
	
	echo form_submit('submit', 'Ubah');
	
echo form_close();
$this->load->view(ADM_URL . '/tpl_footer.php');