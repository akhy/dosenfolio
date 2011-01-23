<?php 
$this->load->view('tpl_header', array('active' => 'staff')); 
?>
<div id="content">
	<div id="info">
<h5>Jurusan Teknik Informatika UII</h5>
<p>Teknik Informatika UII pertama kali menerima mahasiswa baru pada tahun ajaran 1994/1995. Saat ini Teknik Informatika adalah Jurusan ketiga dalam Fakultas Teknologi Industri UII setelah Teknik Kimia dan Teknik Industri. Mahasiswa angkatan pertama berjumlah sekitar 64 orang. Karena keterbatasan tenaga edukatif, maka saat pertama kali berdiri, hanya ada dua dosen tetap di Informatika, yaitu Yudi Prayudi dan Sri Kusumadewi. Namun demikian proses pembelajaran dapat berjalan dengan baik karena selain kedua dosen tetap itu, Teknik Informatika juga dibantu oleh dosen-dosen lain di lingkungan UII bahkan ada beberapa dosen UGM yang dimintakan bantuannya untuk membantu pengelolaan prodi Teknik Informatika. </p>
	</div>
	<div id="dosenlist">
	<?php 
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
	?>	
	</div>


</div>
<?php $this->load->view('tpl_footer') ?>