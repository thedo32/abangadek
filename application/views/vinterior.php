   
	
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

	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	$pesanan = $interior->title;

	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk memesan $pesanan");

	?>

	<div class=h11>
		<p></p>
		<h6>Kontak Whatsapp Pemesanan:</h6>
		<a href="<?php echo $whatsappLink; ?>" target=_blank>
			<img src="/storage/app/public/images/logo/walogo.png" height=50% width=50% alt="Cover Image">
		</a><br>
	</div>
	  
	<table class=read-table>
		<tbody>
			<tr>
				<td><h4><?php echo set_value('title', $interior->title); ?></h4></div></td>
			</tr>
			<tr>
				<td><h5><?php echo htmlspecialchars_decode(set_value('text', $interior->text)); ?></h5></td>
			</tr>
			<tr>
				<td><div class=slideshow-container-post><img src="<?php echo base_url($interior->cover); ?>" height=150% width=150% alt="Cover Image"></div></td>
			</tr>
			<!-- <tr>
				<td>Visitor Location: <?php //echo $city; ?>, <?php //echo $country; ?></p></td>
			</tr> -->
		</tbody>		
	</table>

	<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>

    <script>
		// for go to top button
        $(document).ready(function() {
            // When the user scrolls down 20px from the top of the document, show the button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 20) {
                    $('#myBtn').fadeIn();
                } else {
                    $('#myBtn').fadeOut();
                }
            });

            // When the user clicks on the button, scroll to the top of the document
            $('#myBtn').click(function() {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        });

		// for expand and collapse below navbar
		shiftBelowRTable();
		imageClickable();
	</script>
