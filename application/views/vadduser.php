</head>

<body class="bg-body">
	
    <div class=fix-navbar>
	<?php 
		$this->load->view("fix_logo");
		$this->load->view("fix_menu");
		  // $this->load->view("client_slider");
		  // $this->load->view('side_post');
	?>
	</div>	
	
   <form action="<?php echo base_url('register/add'); ?>" method="post">
    	
		 <table class=reg-table>
			 <tr>
                <td>Nama</td>
                <td><input type="text" name="name" value="<?php echo set_value('name'); ?>" size="20" /></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="20" /></td>
            </tr>
			<tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></td>
            </tr>
			<tr>
                <td>Handphone</td>
                <td><input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" size="25" /></td>
            </tr>
			 <tr>
                <td>Alamat</td>
                <td><input type="text" name="address" value="<?php echo set_value('addres'); ?>" size="80" /></td>
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
                <td><input type="submit" value="Submit Add"></td>
		    </tr>

        </table>
    </form>
	<?php echo validation_errors(); ?>

		<?php // if ($this->session->tempdata('otp_error')): ?>
			<!--	<p style="color: red;"><?php //echo $this->session->tempdata('otp_error'); ?></p> --> 
		<?php //endif; ?>
	 <br><br>


<script>

	// for expand and collapse below navbar
	shiftBelowElements(".reg-table", 200, 300, 1, 2);
	imageClickable();
</script>


