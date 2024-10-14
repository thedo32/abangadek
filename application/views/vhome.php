
</head>

<body class="bg-body">
	<div class=fix-navbar>
		<?php 
			$this->load->view("fix_logo");
		?>
		
	

	 <!-- <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-button" id="close-button">tutup &times;</span>
			<?php // $this->load->view("pop_up_slider"); popup sementara disembunyikan dulu
				
			?>
            
        </div>
    </div> -->
	
	<?php 
		$this->load->view("fix_menu_home");
		// $this->load->view('side_post');
	?>
	</div>
		
	<?php 
		$this->load->view("home_slider");
		$this->load->view('image_slider');
		$this->load->view('wa_container');
		
	?>

	<div id="product" style="width=100%;">
	<?php 
			$this->load->view('product_slider_home');
			//$this->load->view('about_slider_home');
	?>
	</div>


	<div id="client" style="width=100%;">
	<?php 
			$this->load->view("client_slider_home");
	?>
	<div>
	<div id="about" style="width=100%;">
	<?php 
			$this->load->view('post_container_home');
	?>
	<div>


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


		//for dropdown menu
		$(document).ready(function() {
		if ($(window).width() > 768) {
			 $('.nav-item.dropdown').hover(function() {
				 $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
			 }, function() {
				 $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
			 });
			}
		});
			

		// for expand and collapse below navbar
		// shiftBelowContainers();
		//window.onload = shiftBelowContainersHome;

		imageClickable();
	</script>
