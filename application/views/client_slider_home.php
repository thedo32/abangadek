<style>
/* Shake animation */
    @keyframes shake {
        0% { transform: translate(0); }
        25% { transform: translate(-10px, 0); }
        50% { transform: translate(10px, 0); }
        75% { transform: translate(-10px, 0); }
        100% { transform: translate(10); }
    }

	/* Initial hidden state for product-title */
    #client-title {
        display: block; /* Ensure it is always displayed */
        animation: shake 10s ease infinite; /* Add shake animation */
    }
</style>


<div class=texts-container-cl-home>
	<h1><a id="client-title" href="<?php echo base_url('client'); ?>">CLIENT KAMI</a></h1>
	<a href="<?php echo base_url('client'); ?>"><img src="/storage/app/public/images/logo/client.jpg" class=image-container-cl-home></a>
</div>

