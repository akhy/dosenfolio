<?php

foreach($kat as $k)
{
	$options[ "$k->kategori_id" ] = $k->nama_kat;
}
if ( $this->Otoritas->isDosen() )
{
	$dosen_id = $this->Otoritas->getId();
	$nama = $this->Otoritas->getNama();
}


$this->load->helper('form');

echo form_open(ADM_URL . '/karya/add');
	if (isset($dosen_id))
	{
		echo form_hidden('dosen_id', $dosen_id);
		echo heading('Tambahkan karya untuk ' . $nama, 3);
	}
	else 
	{
		foreach($dos as $d)
		{
			$options2[ "$d->dosen_id" ] = $d->nama;
		}
		echo heading('Tambahkan karya untuk: ', 3);
		echo form_label('Nama Dosen', 'dosen_id');
		echo form_dropdown('dosen_id', $options2);
	}
	
	echo form_hidden('referrer', $referrer);
	
	echo form_label('Judul Karya', 'judul');
	echo form_input('judul');
	
	echo form_label('Tahun', 'tahun');
	echo form_input('tahun');
	
	echo form_label('Kategori', 'kategori_id');
	//echo form_input('kategori_id');
	echo form_dropdown('kategori_id', $options);
	
	echo form_label('Deskripsi', 'deskripsi');
	echo form_textarea('deskripsi');
	
	echo form_submit('submit', 'Tambahkan');
echo form_close();