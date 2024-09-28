<!-- <div class=shadowbox><h4>Menjadikan Promosi Anda Tersenyum</h4></div> -->  
        <div class="image-clickable">
			<canvas id="imageCanvas"></canvas>
		</div>
		<br>
		<!-- <a alt="Menara" href="<?php echo base_url('home');?>"><img src="/storage/app/public/images/logo/logo-abangadek.png" class=image-logo></a>-->
		
		<div class=logged-in>
		<?php if ($this->session->userdata("name") === 'Alpha' ):?>
				  <a href="<?php echo base_url('home'); ?>" class=h8>Admin</a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		<?php elseif ($this->session->userdata("name") != Null ):?>
				  <a href="<?php echo base_url('home'); ?>" class=h8><?php echo $this->session->userdata("name"); ?></a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		<?php else:?> 
				<a href="<?php echo base_url('login'); ?>"class=h7>Login</a>
		<?php endif; 
		// echo $this->db->count_all('client');
		?>
		</div>

