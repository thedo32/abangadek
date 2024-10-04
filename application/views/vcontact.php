
        
</head>

<body class="bg-body">
	<div class=fix-navbar>
	<?php 
		$this->load->view("fix_logo");
		$this->load->view("fix_menu");
		$this->load->view("header_slider");
		  // $this->load->view('side_post');
	?>

	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	
	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk menanyakan detail lebih lanjut");

	?>

	<div class=h10> 
		<a href="https://en.kopibatigo.id/home">ENG</a><br>
		<a href="<?php echo $whatsappLink; ?>" target=_blank class="fa fa-whatsapp"></a><br>
		<a href="#" class="fa fa-instagram"></a><br>
		<a href="#" class="fa fa-facebook"></a><br>
	</div>

	
	
		<?php if ($this->session->userdata("name") === 'Alpha' ):?>
		<div class = home-table>
			<h6>Halo <a href="<?php echo base_url('home'); ?>">Admin</a></h6>
			<?php $this->load->view('welcome_message');?>
		</div>
		<?php elseif ($this->session->userdata("name") != Null ):?>
		<div class = home-table>
			<h6>Halo <a href="<?php echo base_url('home'); ?>"><?php echo $this->session->userdata("name"); ?></a></h6>
			<?php $this->load->view('welcome_message');?>
		</div>
		<?php else:?>
			<h6>&nbsp;&nbsp;Silahkan <a href="<?php echo base_url('login'); ?>">Login</a></h6>
			<?php $this->load->view('welcome_guest');?>
		<?php endif; ?>
	</div>
	
	<?php 
		$this->load->view('image_slider');
	?>
	
	<br>
	<div class=slideshow-container-art>  
	  <div class=articlebox>		
		<center><h6>Tentang Desa Wisata Teluk Buo:</h6></center>
		Terletak di Kelurahan Teluk Kabung Tengah, Kecamatan Bungus Teluk Kabung, Kota Padang, Provinsi Sumatera Barat, Indonesia.<br>
		<strong>Desa Wisata Teluk Buo berhasil menembus 100 besar Anugerah Desa Wisata Indonesia (ADWI) tahun 2024.</strong><br>
		Perpaduan pasir putih dan hijau hutan mangrove begitu sempurna, menjadi daya tarik untuk dikunjungi wisatawan.<br>
		Kawasan wisata bahari yang menawan ini tersembunyi di balik batu karang Teluk Buo.<br>
		Keberagaman hutan mangrove menjadikannya sebagai Ekowisata Mangrove yang menyegarkan.<br>
		<strong>Jenis mangrove di lokasi ini adalah:</strong><br>
		Rhizophora apiculate, Sonneratia alba, Avicennia corniculatum, Bruguiera gymnorhiza, dan Xylocarpus granatum <br>
		Desa Wisata Teluk Buo juga memiliki aktivitas nelayan yang menarik untuk disaksikan.<br>
		<strong>Atraksi utama:</strong><br>
		Teluk yang indah dan pantai berpasir putih, Ekowisata Mangrove, Aktivitas nelayan, Berenang, snorkeling, dan memancing, serta Kuliner khas daerah<br>
		<strong>Cara menuju ke sana:</strong><br>
		Desa Wisata Teluk Buo terletak sekitar 30 kilometer dari Pusat Kota Padang, bisa menggunakan transportasi umum atau menyewa mobil untuk sampai ke sana.<br>
		<strong>Penginapan:</strong><br>
		Terdapat beberapa homestay dan guest house yang tersedia di Desa Wisata Teluk Buo, termasuk Homestay dan Camping Ground Kupi Batigo Teluk Buo<br>
		<strong>Tips:</strong><br>
		Bawa tabir surya, lotion anti nyamuk, topi, jangan lupa hormati budaya dan lingkungan setempat.
	  </div>
    </div>

	<?php 
		$this->load->view('wa_container');
	?>
	<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>
	<br><br>

	

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
		shiftBelowElements(".slideshow-container", 150, 270, 1, 2);
		imageClickable();
	</script>
