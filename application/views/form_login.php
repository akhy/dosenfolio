<html>
<head>
	<title>Login &raquo; Portofolio Dosen Informatika UII</title>
	<?php echo link_tag('css/login.css', 'stylesheet'); ?>
</head>
<body>
<h1>Gunakan nomor induk sebagai username</h1>
<?php
	$this->load->helper('form');

	if (validation_errors())
	{
		echo validation_errors();
	} 
	elseif ($pesan != '')
	{
		echo "<div class='$class' >" . $pesan . '</div>';
	}
	echo form_open('login');

		echo form_label('Username', 'user');
		echo form_input('user', set_value('user'));
		
		echo form_label('Password', 'pass');
		echo form_password('pass');
			
		echo form_submit('submit', 'LOGIN');
	
	echo form_close();
?>
</body>
</html>