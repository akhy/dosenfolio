<?php
	if ($this->session->userdata('tipe') == FALSE)
	{
		redirect('login', 'location');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Admin Panel
	</title>
	<?php echo link_tag('css/admin.css', 'stylesheet'); ?>
	<script type="text/javascript" src="<?php echo MY_URL;?>/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.form').hide();
			$('.alert').click(function(){
				$(this).slideUp();
			});
		});
	
		function show($jenis, $id)
		{
			$('.form').slideUp(500);
			$("#" + $jenis + "_" + $id).slideDown(500);
		}
	</script>
</head>	
<body>
<div id="menu-top">&nbsp;</div>
<div id="top" class="nav">
<?php
	
	echo img(array(
	'src' => $this->session->userdata('foto'),
	'width' => '50',
	'height' => '50'
	));
	echo '<div id="menubar">';
	if ($this->Otoritas->isAdmin())
		echo anchor(ADM_URL . '/dosen', 'Dosen');
	elseif ($this->Otoritas->isDosen())
		echo anchor(ADM_URL . '/dosen', 'Edit Profil');
	if ($this->Otoritas->isDosen())
		echo anchor(ADM_URL . '/profpic', 'Edit Foto Profil');
	if ($this->Otoritas->isAdmin())
		echo anchor(ADM_URL . '/karya', 'Karya');
	if ($this->Otoritas->isAdmin())
		echo anchor(ADM_URL . '/kategori', 'Kategori');
	echo anchor(ADM_URL . '/password', 'Ubah Password');
	echo '</div>';
	
	echo '<cite>Logged-in as <strong>' . $this->session->userdata('username') . 
		'</strong> (' . $this->session->userdata('nama') . ') | ' . 
		anchor('logout', 'Logout');
		'</cite>';
	echo '<div style="clear:right"></div>';
?></div>
<div id="menu-bottom">&nbsp;</div>