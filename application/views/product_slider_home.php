<style>
    a {
        color: black;
    }

    a:hover {
        color: blue !important;
    }
	    

    /* Shake animation */
    @keyframes shake {
        0% { transform: translate(0); }
        25% { transform: translate(-10px, 0); }
        50% { transform: translate(10px, 0); }
        75% { transform: translate(-10px, 0); }
        100% { transform: translate(10px); }
    }

    /* Initial style for product-title */
    #product-title {
        font-size: 1.5em;/* 1.5 times larger */
        display: block;
    }

    /* close to navbar style */
    .shakes {
        font-size: 1em; /* Normal size */
        animation: shake 10s ease infinite; /* Add shake animation */
    }
    
    /* Stop shaking when hovered */
    #product-title:hover {
        animation: none;
    }
</style>


    <div class="texts-container-cl-product">
        <h1><a id="product-title" href="<?php echo base_url('produk'); ?>">PRODUK KAMI</a></h1>
    </div>
    <br>

    <table class="product-table-home" style="margin-left: auto; margin-right: auto;"> <!-- Center the table -->
        <tr>
            <td>
                <div class="center-content">
					<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><h1>Printing&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1></a>
                <div class="rotating-gradient">
                    <a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><img src="/storage/app/public/images/logo/printing-sm.png"></a>
                </div>
				</div>
            </td>
            <td>
                <div class="center-content">
                    <div class="rotating-gradient">
                        <a alt="Interior" href="<?php echo base_url('produk/interior'); ?>"><img src="/storage/app/public/images/logo/interior-sm.png"></a>
                    </div>
                    <a alt="Interior" href="<?php echo base_url('produk/interior'); ?>"><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interior</h1></a>
                </div>
            </td>
			<tr>
            <td>
                <div class="center-content">
                    <a alt="Baliho" href="<?php echo base_url('produk/baliho'); ?>"><h1>Baliho&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1></a>
					<div class="rotating-gradient">
                        <a alt="Baliho" href="<?php echo base_url('produk/baliho'); ?>"><img src="/storage/app/public/images/logo/baliho-sm.png"></a>
                    </div>
				</div>
            </td>
      		<td>
				<div class="center-content">
					<div class="rotating-gradient">
						<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><img src="/storage/app/public/images/logo/about-sm.png"></a>
					</div>
					<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About Us</h1></a>
				</div>
			  </td>
			  </tr>
			  <tr>
				<td>
				<div class="center-content">
					<a alt="Printing" href="<?php echo base_url('produk/interior'); ?>"><h1>Digital Ad&nbsp;</h1></a>
					<div class="rotating-gradient">
						<a alt="Digital Ads" href="<?php echo base_url('produk/interior'); ?>"><img src="/storage/app/public/images/logo/digital-sm.png"></a>
					</div>
				</div>
				
				</td>

				<td>
				<div class="center-content">
					<div class="rotating-gradient">
						<a alt="Media Sosial" href="<?php echo base_url('produk/baliho'); ?>"><img src="/storage/app/public/images/logo/socmed-sm.png"></a>
					</div>
					<a alt="Printing" href="<?php echo base_url('produk/baliho'); ?>"><h1>Social Media</h1></a>
				</div>
				</td>
		</tr>
    </table>

<script>
    function adjustProductTitle() {
    const productTitle = document.getElementById('product-title');
    const fixNavbar = document.querySelector('.fix-navbar');
    const productSection = document.querySelector('.texts-container-cl-product');

    const navbarBottom = fixNavbar.getBoundingClientRect().bottom;
    const productTop = productSection.getBoundingClientRect().top;

    // Calculate absolute distance and make sure it's a whole number
    const distance = Math.floor(Math.abs(productTop - navbarBottom));
	
	//log to check
	 //console.log('Distance Product:', distance);

    // Check if the distance is less than a threshold
    if (distance < 170) {
        // Close to navbar: apply shaking and reset to smaller font size
        productTitle.classList.add('shakes');
        productTitle.style.fontSize = '1em'; // Normal size
    } else {
        // Far from navbar: enlarge and stop shaking
        productTitle.classList.remove('shakes');
        productTitle.style.fontSize = '1.5em'; // Enlarge font size
    }
}

// Trigger the font size and animation change on scroll
window.addEventListener('scroll', adjustProductTitle);
</script>
