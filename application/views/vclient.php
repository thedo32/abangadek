   
	
</head>

<body class="bg-body">
	<div class=fix-navbar>
		<?php 
		$this->load->view("fix_logo");
		$this->load->view("fix_menu");
		// $this->load->view("client_slider");
		// $this->load->view('side_post');
	?>

	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	$pesanan = $client->title;

	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk memesan $pesanan");

	?>

	<div class=h11>
		<p></p>
		<a href="#">
			<img src="/storage/app/public/images/logo/walogo.png" style="opacity:0; left:30; height:60%; width=60%;" alt="Cover Image">
		</a><br>
	</div>

	<div class=detail-breadcrumb>
		<a href="<?php echo base_url('client'); ?>"><h4>Kembali Ke Client List</h4></a>
	</div>
		  
	<table class=read-table>
		<tbody>
			<tr style="font-size:2em !important;">
				<td><h2><?php echo set_value('title', $client->title); ?></h2></td>
			</tr>
			<tr style="font-size:1.4em !important;">
				<td><h4><?php echo htmlspecialchars_decode(set_value('text', $client->text)); ?></h4></td>
			</tr>
			<tr>
				<td><div class=slideshow-container-cover><img src="<?php echo base_url($client->cover); ?>" width=130% alt="Cover Image"></div></td>
			</tr>
			<!-- <tr>
				<td>Visitor Location: <?php //echo $city; ?>, <?php //echo $country; ?></p></td>
			</tr> -->
		</tbody>		
	</table>

	<button id="waBtn" title="Whatsapp Btn">Whatsapp</button>
	<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>

    <script>
		//whatsapp button
	    document.getElementById('waBtn').onclick = function() {
		   window.open('<?php echo $whatsappLink; ?>', '_blank');
		};


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
		shiftBelowElements(".read-table", 200, 300, 1, 2);
		imageClickable();
	</script>

