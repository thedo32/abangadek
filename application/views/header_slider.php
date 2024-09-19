<!-- slider dari BarajaCoding -->
<br>
<div class="slideshow-container">
	<div class="prev" onclick="plusSlideHead(-1)">&#10094;</div>
    <div class="next" onclick="plusSlideHead(1)">&#10095;</div>
	
	<div class="mySlides">
		<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><img src="<?php echo base_url ("/storage/app/public/images/slider/1.png");?>" style="width:100%"></a>
		<!-- < <div class="text">Caption One</div> --> 
	</div>

	<div class="mySlides">
		<a alt="Interior" href="<?php echo base_url('produk/interior');?>"><img src="<?php echo base_url ("/storage/app/public/images/slider/2.png");?>" style="width:100%"></a>
		<!-- <div class="text">Caption Two</div> -->
	</div>

	<div class="mySlides">
		<a alt="Baliho" href="<?php echo base_url('produk/baliho'); ?>"><img src="<?php echo base_url ("/storage/app/public/images/slider/3.png");?>" style="width:100%"></a>
		<!-- <div class="text">Caption Three</div> -->
	</div>
</div>

<script>
	//function for header slider
	var slideIndex = 0;
	showSlides(slideIndex); // Initialize slideshow

</script>

<!-- end of slider dari BarajaCoding -->
