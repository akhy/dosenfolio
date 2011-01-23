<?php
echo '<p>' .
	anchor(ADM_URL . '/kategori/delete/' . $kat->kategori_id, img(array('src' => 'images/crud_delete.png', 'alt' => '(hapus)', 'class' => 'crud'))) . ' ' .
	anchor(ADM_URL . '/kategori/edit/' . $kat->kategori_id, img(array('src' => 'images/crud_edit.png', 'alt' => '(edit)', 'class' => 'crud'))) . ' |  ' .
	$kat->nama_kat . '</p>'; 