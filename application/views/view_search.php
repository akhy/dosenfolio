<?php
	$this->load->view('tpl_header');
	
	if (! $dosens)
	{
		echo "tidak ditemukan";
	}
	else
	{
		foreach($dosens as $dosen) :
			echo '<div class="datacard" onclick="showBiografi(' . $dosen->dosen_id . ')">';
			echo img(array(
				'src' => $this->Foto->getFoto($dosen->dosen_id ,50),
				'width' => '50',
				'height' => '50'
			));
			echo '<h4>' . anchor('staff/view/' . url_title($dosen->nama, 'dash', TRUE) . '-' . $dosen->dosen_id , $dosen->nama) . '</h4>';
			echo clear();
			echo '</div>';
		endforeach;		
	}
	
	$this->load->view('tpl_footer');
?>