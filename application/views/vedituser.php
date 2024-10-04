 
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
				  <a href="<?php echo base_url('home'); ?>" class=h8>Admin</a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		</div>

	

	<?php 
		$this->load->view("fix_menu");
		  // $this->load->view("client_slider");
		  // $this->load->view('side_post');
	?>
	


    <!-- form action style for editing a user -->
    <form action="<?php echo base_url('register/edit/' . $user->id); ?>" method="post">
        <table class=reg-table>
			<tr>
                <td>Nama</td>
                <td><input type="text" name="name" value="<?php echo set_value('name', $user->name); ?>" size="20"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo set_value('username', $user->username); ?>" size="20" ></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo set_value('email', $user->email); ?>" size="50" ></td>
            </tr>
			<tr>
				<td>Handphone</td>
                <td><input type="text" name="mobile" value="<?php echo set_value('mobile', $user->mobile); ?>" size="25"></td>
            </tr>
			<tr>
				<td>Alamat</td>
                <td><input type="text" name="address" value="<?php echo set_value('address', $user->address); ?>" size="100" ></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" /></td>
            </tr>
			<tr>
                <td>Confirm Password</td>
                <td><input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Submit Edit"></td>
            </tr>
        </table>
    </form>
	<!-- Display validation errors -->
	<?php echo validation_errors(); ?>
	<br><br>

<script>

	// for expand and collapse below navbar
	shiftBelowElements(".reg-table", 200, 300, 1, 2);
	imageClickable();
</script>
	
