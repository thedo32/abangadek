

</head>
<body="bg-body">
   <?php echo validation_errors(); ?>

	 <div class=fix-navbar>
	 <?php 
		$this->load->view("fix_logo");
		$this->load->view("fix_menu");
		  // $this->load->view("client_slider");
		  // $this->load->view('side_post');
	 ?>


	 <form action="<?php echo base_url('register/add'); ?>" method="post">
        <table class=login-table>
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
                <td><input type="text" name="address" value="<?php echo set_value('address'); ?>" size="100" /></td>
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
                <td><input type="submit" value="Add User"></td>
		    </tr>
        </table>
    </form>

	    <br>

<script>

	// for expand and collapse below navbar
	shiftBelowElements(".login-table", 200, 350, 1, 2);
	imageClickable();
</script>
	
