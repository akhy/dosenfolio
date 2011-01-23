		<?php $this->load->view('form_search') ?>
		<div id="footer">
			&copy; 2011 Jurusan Teknik Informatika Universitas Islam Indonesia <br />
			<?php 
			if ( ! $this->Otoritas->hasRights() )
				echo anchor('login', '[Login to this site]');
			
			?>
		</div>
	</div>
</body>
</html>
