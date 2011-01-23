<?php
$nama_kat = $this->Kategori_mod->getKategoriName($karya->kategori_id);
if ($nama_kat == NULL)
	$nama_kat = ' ';

$nama_dos = $this->Dosen_mod->getDosenName($karya->dosen_id);
if ($nama_dos == NULL)
	$nama_dos = ' ';

echo '<div class="entity">';
echo '<h2>' . $karya->tahun . ' &middot; ' . $karya->judul . '</h2>'; 
echo '<h3>' . $nama_kat . ' oleh ' . $nama_dos . '</h3>';
	
	$arr1 = array(
	'onclick' => 'return confirm(\'Yakin mau hapus data ini?\')', 
	'title' => 'Hapus',
	'class' => 'button hapus'
	);
	$arr2 = array(
	'title' => 'Edit',
	'class' => 'button edit'
	);
	echo anchor(ADM_URL . '/karya/delete/' . $karya->karya_id, 'Hapus', $arr1 ) . nbs();
	echo anchor(ADM_URL . '/karya/edit/' . $karya->karya_id, 'Edit', $arr2 );
	
	echo '<blockquote>' . $karya->deskripsi . '</blockquote>'; 
echo '</div>';