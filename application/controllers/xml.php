<?php

class Xml extends Controller {
	function Xml()
	{
		parent::Controller();
		
		$this->load->model('Dbku', 'Dosen');
		$this->Dosen->initialize('dosen');
		
		$this->load->library('table');
	}

	
	function index()
	{
	
	}
	
	function get_biografi($id)
	{
		$this->load->helper('typography');
		
		$dosen = $this->Dosen->getOne_where('dosen_id', $id);
		
		if ($dosen != FALSE)
		{
			echo '<h5>' . $dosen->nama . '</h5>';
			
			
			// list biografi
			$this->load->helper('email');
			$emails = getMails($dosen->email, FALSE);
			$homepages = getHomepages($dosen->homepage);
			
			echo '<div class="data">';
			
			echo '<h2>Date of birth</h2>' . $dosen->kelahiran;
			echo '<h2>Address</h2>' . $dosen->alamat;
			echo '<h2>Phone number</h2>' . $dosen->telpon;
			echo '<h2>Email address</h2>' . $emails;
			echo '<h2>Homepage</h2>' . $homepages;
		
			echo '</div>';
			

			
			
			echo '<br />' . anchor('staff/view/' . url_title($dosen->nama, 'dash', TRUE) . '-' . $dosen->dosen_id, 'More...', array('class' => 'button'));
		}
		else
		{
			echo 'error';
		}
	}
	
	function get_dosenList($like)
	{
		$like = $this->db->escape_like_str($like);
		//echo ;
		$dosens = $this->Dosen->query("SELECT * FROM dosen WHERE nama LIKE '%$like%' LIMIT 10");
		foreach ($dosens as $dosen)
		{
			echo '<li onClick="fill(\''.$dosen->nama.'\');">'.$dosen->nama.'</li>';
		}
	}		
}