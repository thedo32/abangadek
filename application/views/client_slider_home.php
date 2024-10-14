<style>
/* Shake animation */
    @keyframes shake {
        0% { transform: translate(0); }
        25% { transform: translate(-10px, 0); }
        50% { transform: translate(10px, 0); }
        75% { transform: translate(-10px, 0); }
        100% { transform: translate(10px); }
    }

    /* Initial style for client-title */
    #client-title {
        font-size: 1.5em;/* 1.5 times larger */
        display: block;
    }

    /* close to navbar style */
    .shakes-client {
        font-size: 1em; /* Normal size */
        animation: shake 10s ease infinite; /* Add shake animation */
    }
    
    /* Stop shaking when hovered */
    #client-title:hover {
        animation: none;
    }
</style>


<div class=texts-container-cl-client>
	<h1><a id="client-title" href="<?php echo base_url('client'); ?>">CLIENT KAMI</a></h1>
	<div class=texts-container-cl-home>
		<h4>Berbagai perusahaan telah mempercayakan kami sebagai mitra <br> untuk meningkatkan promosi mereka</h4>
	</div>
	<a href="<?php echo base_url('client'); ?>"><img src="/storage/app/public/images/logo/client.jpg" class=image-container-cl-home></a>
</div>

<script>
    function adjustClientTitle() {
    const clientTitle = document.getElementById('client-title');
    const fixNavbar = document.querySelector('.fix-navbar');
    const clientSection = document.querySelector('.texts-container-cl-client');

    const navbarBottom = fixNavbar.getBoundingClientRect().bottom;
    const clientTop = clientSection.getBoundingClientRect().top;

    // Calculate absolute distance and make sure it's a whole number
    const distance = Math.floor(Math.abs(clientTop - navbarBottom));
	
	//log to check
	 //console.log('Distance Client:', distance);

    // Check if the distance is less than a threshold
    if (distance < 170) {
        // Close to navbar: apply shaking and reset to smaller font size
        clientTitle.classList.add('shakes');
        clientTitle.style.fontSize = '1em'; // Normal size
    } else {
        // Far from navbar: enlarge and stop shaking
        clientTitle.classList.remove('shakes');
        clientTitle.style.fontSize = '1.5em'; // Enlarge font size
    }
}

// Trigger the font size and animation change on scroll
window.addEventListener('scroll', adjustClientTitle);
</script>

