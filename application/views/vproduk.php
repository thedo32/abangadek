        
</head>

<body class="bg-body">
	<div class=fix-navbar>
		<?php 
			$this->load->view("fix_logo");
			$this->load->view("fix_menu");
			$this->load->view("header_slider");
			// $this->load->view('side_post');
		?>
	</div>
	
	<?php 
		$this->load->view('image_slider');
		$this->load->view('product_slider');
		$this->load->view('about_slider');
		$this->load->view('wa_container');
		$this->load->view('product_container');
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
		shiftBelowSlide();
		imageClickable();
	</script>
