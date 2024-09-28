   
	
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
	
	$pesanan = $baliho->title;

	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk memesan $pesanan");

	?>

	<div class=h11>
		<p></p>
		<a href="#">
			<img src="/storage/app/public/images/logo/walogo.png" style="opacity:0; left:30; height:60%; width=60%;" alt="Cover Image">
		</a><br>
	</div>

	<?php
	// Assume $realcoord is fetched from your database or passed dynamically
	$realcoord = $baliho->realcoord; // Example value: "-0.9426739879486935,100.35564711259373"

	// Split the coordinates into latitude and longitude
	list($latitude, $longitude) = explode(',', $realcoord);

	// Generate the Google Maps link
	$googleMapsLink = "https://www.google.com/maps?q=$latitude,$longitude";
	?>
		  
	<table class=read-table>
		<tbody>
			<tr>
				<td><h3><?php echo set_value('title', $baliho->title); ?></h3></td>
			</tr>
			<tr>
				<td><h4><?php echo htmlspecialchars_decode(set_value('text', $baliho->text)); ?></h4></td>
			</tr>
			<tr>
				<td><div class=slideshow-container-post><img src="<?php echo base_url($baliho->cover); ?>" height=130% width=130% alt="Cover Image"></div></td>
			</tr>
			<!-- <tr>
				<td>Visitor Location: <?php //echo $city; ?>, <?php //echo $country; ?></p></td>
			</tr> -->
		</tbody>		
	</table>
	<table class=detail-table>
		  <tr>
				<td>
					<div class=slideshow-container-map>	
					<a href="<?php echo $googleMapsLink; ?>" target="_blank"><h5>Lihat di Google Maps</h5></a><br>
					<iframe
					src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1186.0195415491994!2d<?php echo $longitude; ?>!3d<?php echo $latitude; ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMMKwNTYnMzQuMiJTIDEwMMKwMjEnMjIuMyJF!5e0!3m2!1sen!2sid!4v1727339715134!5m2!1sen!2sid"
					width="700"
					height="400"
					style="border:0;"
					allowfullscreen=""
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade">
					</iframe>
				</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class=slideshow-container-map>
					<a href="#"><h5>Klik Kanan Atas Utk Memperbesar Streetview</h5></a><br>
					<?php
						// Assume $baliho->streetview is already defined in your context
						if (strpos($baliho->streetview, "Tidak tersedia pratinjau") !== false) {
							// Display the message if Street View is not available
							echo '<p>Tidak tersedia pratinjau "Google Streetview" di Lokasi Ini.</p>';
						} else {
						// Display the iframe if Street View is available
							echo '<iframe
								src="' . htmlspecialchars($baliho->streetview) . '"
								width="700"
								height="400"
								style="border:0;"
								allowfullscreen=""
								loading="lazy"
								referrerpolicy="no-referrer-when-downgrade">
								</iframe>';
						}
					?>
					</div>
		 		 </td>
				</tr>	
			  </div>
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
		shiftBelowRTable();
		imageClickable();
	</script>
