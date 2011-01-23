<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
	$subtitle = (isset($subtitle)) ? ' &raquo; ' . $subtitle : '';
?>
<title>Jurusan Teknik Informatika UII <?php echo $subtitle ?></title>
<?php echo link_tag('css/home.css', 'stylesheet'); ?>
<?php echo link_tag('js/tipTip.css', 'stylesheet'); ?>
<!--[if IE]>
  <script src="<?php echo base_url(); ?>js/innershiv.min.js"></script>
  <script src="<?php echo base_url(); ?>js/html5.js"></script>
<![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tipTip.minified.js"></script>
<?php echo link_tag('js/skins/tango/skin.css', 'stylesheet'); ?>
<script language="javascript">
	$(document).ready(function(){
		$('#thumbs img').tipTip({edgeOffset: -20, maxWidth: 400});
		$('blockquote.karya').hide();
		
		$('#carousel').jcarousel({
			visible: '6',
			easing: 'easeInQuad'
		});


		$('#showAbout').click(function(){
			if ( $(this).hasClass('active') )
			{
				$('section#big hgroup').fadeIn();
				$('#about').fadeOut();
			} 
			else 
			{
				$('section#big hgroup').fadeOut();
				$('#about').fadeIn();
			}
			
			$(this).toggleClass('active');
			$('#searchBox').fadeOut();
			$('a.search').removeClass('active');
			
			return false;
		});
		
		$('a.search').click(function(){
			if ( $(this).hasClass('active') )
			{
				$('#searchBox').fadeOut();
				
			}
			else
			{
				$('#searchBox').fadeIn();
			}
			$('a.search').toggleClass('active');
			
			$('section#big hgroup').fadeIn();
			$('#about').fadeOut();
			$('#showAbout').removeClass('active');
			
			return false;
		});

	});
	
	function hidekarya()
	{
		$('blockquote.karya').slideUp();	
	}
	
	function showkarya($id)
	{
		if ($('#karya-' + $id).css('display') == 'none')
		{
			$('#karya-' + $id).slideDown(200);
		}
		else
		{
			hidekarya();
		}
		
	}
	function showBiografi(id)
	{
		img = '<?php echo img('images/ajax-loader.gif')?>';
		$('#info').html(img)
		$.ajax({
			url: '<?php echo base_url();?>xml/get_biografi/' + id,
			success: function(data){
				$('#info').fadeOut(100, function(){
					$('#info').html(data);
					$('#info').fadeIn();
					document.location = '#info';
				} );
				
			}
		});
	}
	function hideBiografi()
	{
		$('#info').html('');
	}
	
	
	function lookup(inputString) 
	{
		if(inputString.length == 0) 
		{
			// Hide the suggestion box.
			$('#suggestions').hide();
		} 
		else 
		{
			$.post("<?php echo base_url(); ?>xml/get_dosenList/" + inputString, function(data)
			{
				if(data.length >0)
				 {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) 
	{
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
</head>

<body>
	<?php if ( $this->Otoritas->hasRights() ) :?>
		<div id="userBar"><div>
			Anda login sebagai: 
			<?php
			if  ( $this->Otoritas->isAdmin() )
				echo '<strong>Administrator</strong>';
			elseif ( $this->Otoritas->isDosen() )
				echo '<strong>' . $this->Otoritas->getNoInduk() . ' - ' . $this->Otoritas->getNama() . '</strong>';
			
			echo ' | ' . anchor(ADM_URL . '/manage', 'ADMIN PANEL') .
				' | ' . anchor('logout', 'LOGOUT');
			?>
		</div></div>
	<?php endif; ?>
	<div id="container">
		<header>
			<img src="<?php echo base_url(); ?>/images/uii.gif" alt="Universitas Islam Indonesia"></img>
			<div>
			<?php
				echo anchor('home', 'Home');
				
				$staffClass = ($active == 'staff') ? '' : '';
				echo anchor('staff/all', 'Staffs', array('class' => $staffClass));
				
				echo anchor('search', 'Search', array('class' => 'search'));
				
				$aboutClass = ($active == 'about') ? 'active' : '';
				if ($active == 'staff'){
					echo anchor('about', 'About Us');
				}
				elseif ($active == 'about')
				{
					echo anchor('', 'About Us', array('class' => 'active') );
				}		
				else
				{
					echo anchor('', 'About Us', array('onclick' => 'return false', 'id' => 'showAbout', 'class' => $aboutClass));
				}
			?>
			</div>
			
		</header>
		<div style="clear: both"></div>