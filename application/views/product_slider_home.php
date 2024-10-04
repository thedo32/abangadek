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
        100% { transform: translate(10); }
    }

	/* Initial hidden state for product-title */
    #product-title {
        display: block; /* Ensure it is always displayed */
        animation: shake 10s ease infinite; /* Add shake animation */
    }
</style>


    <div class="texts-container-cl-home">
        <h1><a id="product-title" href="<?php echo base_url('produk'); ?>">PRODUK KAMI</a></h1>
    </div>
    <br>

    <table class="product-table" style="margin-left: auto; margin-right: auto;"> <!-- Center the table -->
        <tr>
            <td>
                <div class="center-content">
                    <div class="rotating-gradient">
                        <a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
                    </div>
                    <a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><h1>Printing</h1></a>
                </div>
            </td>
            <td>
                <div class="center-content">
                    <div class="rotating-gradient">
                        <a alt="Interior" href="<?php echo base_url('produk/interior'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
                    </div>
                    <a alt="Interior" href="<?php echo base_url('produk/interior'); ?>"><h1>Interior</h1></a>
                </div>
            </td>
            <td>
                <div class="center-content">
                    <div class="rotating-gradient">
                        <a alt="Baliho" href="<?php echo base_url('produk/baliho'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
                    </div>
                    <a alt="Baliho" href="<?php echo base_url('produk/baliho'); ?>"><h1>Baliho</h1></a>
                </div>
            </td>
        </tr>
		<tr>
		<td>
				<div class="center-content">
					<div class="rotating-gradient">
						<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
					</div>
					<a alt="Printing" href="<?php echo base_url('produk/printing'); ?>"><h1>About Us</h1></a>
				</div>
				
				</td>
			
				<td>
				<div class="center-content">
					<div class="rotating-gradient">
						<a alt="Digital Ads" href="<?php echo base_url('produk/interior'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
					</div>
					<a alt="Printing" href="<?php echo base_url('produk/interior'); ?>"><h1>Digital Ad</h1></a>
				</div>
				
				</td>

				<td>
				<div class="center-content">
					<div class="rotating-gradient">
						<a alt="Media Sosial" href="<?php echo base_url('produk/baliho'); ?>"><img src="/storage/app/public/images/logo/logo-sm.png"></a>
					</div>
					<a alt="Printing" href="<?php echo base_url('produk/baliho'); ?>"><h1>Social Media</h1></a>
				</div>
				</td>
		</tr>
    </table>


