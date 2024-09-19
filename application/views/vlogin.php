	
	
	<!-- script for temporary notification -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Delay in milliseconds (e.g., 8000 ms = 8 seconds)
			var delay = 8000;

			// Hide the message after the delay
			setTimeout(function() {
				$('#addeditSuccessMessage').fadeOut(5000, function() {
                $(this).remove();
				});
			}, delay);
		});
	</script>
</head>

<body class="bg-body">
    <div class=fix-navbar>
		<!-- <div class=shadowbox><h4>Menjadikan Promosi Anda Tersenyum</h4></div> -->
		<div class="image-clickable">
			<canvas id="imageCanvas"></canvas>
		</div>
		<br>
		<!-- <a alt="Menara" href="<?php echo base_url('home');?>"><img src="/storage/app/public/images/logo/logo-abangadek.png" class=image-logo></a>-->
		
		
		<div class=logged-in>
			<a href="<?php echo base_url('login'); ?>"class=h7>Login</a>
		</div>

		<?php 
			$this->load->view("fix_menu");
		?>	
		</div>
	

   
    <form action="<?php echo base_url('login/actionlogin'); ?>" method="post">

        <table class=login-table>

            <tr>

                <td>Username</td>

                <td><input type="text" name="username"></td>

            </tr>

            <tr>

                <td>Password</td>

                <td><input type="password" name="password"></td>

            </tr>

            <tr>

                <td></td>

                <td><input type="submit" value="Login"></td>

            </tr>



        </table>

    </form>

	

	 <!-- notification if login error -->
    <?php if ($this->session->tempdata('error_login')): ?>
		<p id="addeditSuccessMessage" style="color: red;"><?php echo $this->session->tempdata('error_login'); ?></p>
    <?php endif; 

	if ($this->session->tempdata('email_sent')): ?>
		<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_sent'); ?></p>
    <?php elseif ($this->session->tempdata('email_failed')): ?>
		<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_failed'); ?></p>
    <?php endif; ?>
	
	<?php //$this->load->view('welcome_login');?>
	
	
<script>

	// for expand and collapse below navbar
	shiftBelowLTable();
	imageClickable();
</script>
