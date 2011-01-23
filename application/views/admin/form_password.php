<?php
	$this->load->view(ADM_URL . '/tpl_header');
	$this->load->helper('form');
	echo validation_errors();
	if ($pesan != '')
	{
		echo "<div class='$class'>" . $pesan . '</div>';
	}
	echo form_open(ADM_URL . '/password');

		echo form_label('Password Lama', 'pass_old');
		echo form_password('pass_old');
		
		echo form_label('Password Baru', 'pass_new');
		echo form_password('pass_new');
		
		echo form_label('Konfirmasi', 'pass_conf');
		echo form_password('pass_conf');
			
		echo form_submit('submit', 'Ubah Password');
	
	echo form_close();
	$this->load->view(ADM_URL . '/tpl_footer.php');