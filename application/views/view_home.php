<?php 
$data['active'] = (isset($isAbout)) ? 'about' : '';
$this->load->view('tpl_header', $data) 

?>
		<section id="big">

			<hgroup>
				<h2>Fakultas Teknologi Industri</h2>
				<h1>Jurusan Teknik Informatika</h1>
				<h2>Universitas Islam Indonesia</h2>
			</hgroup>

		</section>
	
		<?php
			$aboutStyle = (! isset($isAbout)) ? 'style="display:none;"' : '';
		?>
		<div id="about" <?php echo $aboutStyle ?> >
			<?php $this->load->view('view_about') ?>
		</div>
		
		

		
		<?php 
		$data['dosens'] = $dosens;
		$this->load->view('view_staff_carousel', $data); 
		?>

<?php $this->load->view('tpl_footer') ?>