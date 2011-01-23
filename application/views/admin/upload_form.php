<?php 

echo img($foto);

$statusGravatar = ($isGravatar == 1) ? 'Aktif' : 'Non-aktif';

if ($isGravatar == 0) :
	
	if (! $default)
		echo '<div>' . anchor(ADM_URL . '/profpic/delete', 'Hapus Foto', array('class' => 'button', 'title' => 'Hapus Foto')) . '</div>';
	
	if ($error != '')
		echo '<div class="alert">' . $error . '</div>';
	
	echo '<div class="info">' . 
		'Filetype yang diizinkan: <strong>jpg/gif/png</strong> <br>' . 
		'Ukuran file maksimum: <strong>200kb</strong> <br>' . 
		'Dimensi maksimum: <strong>1024x768 piksel</strong> <br>' . 
		'Foto akan di-resize menjadi ukuran <strong>150x150 piksel</strong> <br>' . 
		'Disarankan menggunakan foto yang <strong>tinggi dan lebarnya sama</strong> <br>' . 
		'</div>';
	?>
	<?php echo form_open_multipart(ADM_URL . '/profpic');?>
	<?php echo form_label('Pilih file yang akan di-upload: ', 'userfile');?>
	<input type="file" name="userfile" size="20" />
	<?php echo form_hidden('ispost', 'yes') ?>
	
	<br />
	
	<input type="submit" value="upload" />
	
	<?php echo form_close();?>

<?php endif; ?>
<div class="info">
<p>
	Status gravatar: <strong><?php echo $statusGravatar; ?></strong>
</p>
<p>
	Bila anda memiliki akun di <?php echo anchor('http://en.gravatar.com', 'Gravatar')?> atau blog di <?php echo anchor('http://wordpress.com', 'WordPress.com') ?>, anda dapat menggunakan <em>"gravatar"</em> di kedua layanan tersebut sebagai foto profil. Untuk itu masukkan email yang anda gunakan pada layanan tersebut sebagai email (pertama) di <?php echo anchor(ADM_URL . '/dosen', 'form pengeditan profil') ?>. Dan klik tombol di bawah ini.
</p>
</div>
<?php 
	if (! $isGravatar) : 
		echo anchor(ADM_URL . '/dosen/gravatar/1', 'Aktifkan Gravatar', array('class' => 'button')) . ' ';
	else :
		echo anchor(ADM_URL . '/dosen/gravatar/0', 'Non-Aktifkan Gravatar', array('class' => 'button'));
	endif;
?>

