<html>
<head>
	<title><?php echo $dosen->nama; ?></title>
	<style type="text/css">

body{
	background-color: white;
	padding: 20px 20px 50px;
	font-family: calibri, Arial, Verdana, sans;
	font-size: 11px;
}
strong, b, .em{
	font-weight: bold;
}
.url a{
	color: inherit;
	text-decoration: none;
}

h1#title{
	font-family: Cambria;
	font-size: 36px;
	font-weight: normal;
	padding: 0.3em;
	text-transform: uppercase;
	font-weight: bold;
	color: #17365d;
}
	span.lower{
		font-size: 0.85em;
	}

table#body td{
	padding: 10px;
	vertical-align: top;
	border: none;
}
	#body h1, #body h2{
		color: #444;
		border-bottom: 1px solid gray;
	}
	
	div.data h3{
		font-weight: bold;
	}
	
	h1{
		font-size: 20px;
	}
	
	h2{
		margin-top: 1.5em;
		font-size: 14px;
		text-transform: uppercase;
	}
	h2:first-letter{
		font-size: 1.2em;
	}
		blockquote{
			padding: 0 0 0 1em; margin: 0;
			font-style: italic;
		}
		blockquote p{
			margin: 0.7em 0;
		}
	h3, table{
		font-size: 11px;
		font-weight: normal;
		margin: 0.5em 0 0;
	}
	
	</style>
</head>
<body>
<h1 id="title">C<span class="lower">URRICULUM</span> V<span class="lower">ITAE</span></h1>
<table id="body">
	<tr>
	<td>
		<?php 
		$foto_url = $this->Foto->getFoto($dosen->dosen_id);
		echo img(array('src' => $foto_url, 'width' => '100', 'height' => '100')); 
		?>
	</td>
	<td>
	<?php 
	
	
		// nama
		echo  '<h1 id="nama">' . $dosen->nama . '</h1>';
		
	
		// list biografi
		$this->load->helper('email');
		$emails = getMails($dosen->email, FALSE);
	
		$homepages = getHomepages($dosen->homepage);
		
		echo '<div class="data">';
		
		echo '<h3>Date of birth</h3>' . $dosen->kelahiran;
		echo '<h3>Address</h3>' . $dosen->alamat;
		echo '<h3>Phone number</h3>' . $dosen->telpon;
		echo '<h3>Email address</h3>' . $emails;
		echo '<h3>Homepage</h3>' . $homepages;
	
		echo '</div>';
		
		echo '<h2 id="biografi">' . 'Biography' . '</h2>';
		$this->load->helper('typography');
		if ($dosen->biografi != '')
			echo '<blockquote>' . auto_typography($dosen->biografi) . '</blockquote>';
		
		
		
		// list pendidikan
		if ($this->Pendidikan->count('dosen_id', $dosen->dosen_id) > 0)
		{
			echo '<h2 id="pendidikan">' . 'Education' . '</h2>';
			$pendidikans = $this->Pendidikan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'thn_masuk');
			foreach($pendidikans as $pend)
			{
				if ($pend->thn_lulus != '0000' && $pend->thn_lulus != NULL)
					$pend->thn_lulus = ' - ' . $pend->thn_lulus;
				else 
					$pend->thn_lulus = '';
					
				echo '<h3>' . $pend->thn_masuk . $pend->thn_lulus . ' - <span class="em">' . $pend->derajat . ' ' .
					$pend->prodi . ' at ' . $pend->institusi .
					' (' . $pend->gelar . ')</span></h3>'; 
			}
		}
		
		// portofolio
		if ($this->Karya->count('dosen_id', $dosen->dosen_id) > 0)
		{
			echo '<h2 id="portofolio">' . 'Portfolio' . '</h2>';
			$karyas = $this->Karya->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
			foreach($karyas as $karya)
			{
				$kid = $karya->karya_id;
				
				$kategori = $this->Kategori->getOne_where('kategori_id', $karya->kategori_id);
				$nama_kat = $kategori->nama_kat;
				
				$judul = $karya->deskripsi == '' ?  '<span class="em">' . $karya->judul . '</span>' : '<span class="em hasSub">' . $karya->judul . '</span>';
				$judul .= ' (' . $nama_kat . ')'; 
				echo '<h3 class="hasSub" onclick="showkarya(' . $kid . ')">' . $karya->tahun . " - $judul</h3>"; 
				if($karya->deskripsi != '')
					echo "<blockquote class='karya' id='karya-$kid'>" . auto_typography($karya->deskripsi) . '</blockquote>';
			}
		}
		
		// list prestasi
		
		if ($this->Penghargaan->count('dosen_id', $dosen->dosen_id) > 0)
		{
			echo '<h2 id="penghargaan">' . 'Achievement' . '</h2>';
			$penghargaans = $this->Penghargaan->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
			foreach($penghargaans as $peng)
			{
					
				echo '<h3>' . $peng->tahun . ' - <span class="em">' . $peng->nama . ' ' .
					' (' . $peng->institusi . ') </span></h3>'; 
			}
		}
		
		// list beasiswa	
		if ($this->Beasiswa->count('dosen_id', $dosen->dosen_id) > 0)
		{
			echo '<h2 id="beasiswa">' . 'Scholarship' . '</h2>';
			$beasiswas = $this->Beasiswa->get_where('dosen_id', $dosen->dosen_id, NULL, FALSE, 'tahun');
			foreach($beasiswas as $bea)
			{
				echo '<h3>' . $bea->tahun . ' | ' . $bea->nama . ' ' .
					' (' . $bea->instansi . ')</h3>'; 
			}
		}
		
	?>
	</td>
	</tr>
</table>
</body>
</html>