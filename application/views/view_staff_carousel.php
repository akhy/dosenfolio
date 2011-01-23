<?php
	$isSingle = (isset($isSingle)) ? 'single' : '';
	echo '<div id="thumbs" class="' . $isSingle . '">';
	echo '<ul id="carousel" class="jcarousel-skin-tango">';
	foreach($dosens as $dosen)
	{
		$foto_url = $this->Foto->getFoto($dosen->dosen_id, 64);
		$img = img(array(
			'src' => $foto_url,
			'alt' => $dosen->nama,
			'title' => $dosen->nama,
			'width' => '64'
		));
		echo '<li>' . anchor('staff/view/' . url_title($dosen->nama, 'dash', TRUE) . '-' . $dosen->dosen_id, $img) . '</li>';
	}
	echo '</ul></div>';
?>