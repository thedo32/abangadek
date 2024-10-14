<style>
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

    /* Initial style for about-title */
    #about-title {
        font-size: 1.5em;/* 1.5 times larger */
        display: block;
    }

    /* close to navbar style */
    .shakes-about {
        font-size: 1em; /* Normal size */
        animation: shake 10s ease infinite; /* Add shake animation */
    }
    
    /* Stop shaking when hovered */
    #about-title:hover {
        animation: none;
    }
</style>
<div class=texts-container-cl-about>
	<h1><a id="about-title" style="color:white;" href="<?php echo base_url('about'); ?>">TENTANG KAMI</a></h1>
</div>

<div class=post-container-3>
	<a href="<?php echo base_url('about'); ?>"><img src="/storage/app/public/images/logo/about.jpg" class=image-container-cl-home></a>
</div>


<script>
    function adjustAboutTitle() {
    const aboutTitle = document.getElementById('about-title');
    const fixNavbar = document.querySelector('.fix-navbar');
    const aboutSection = document.querySelector('.texts-container-cl-about');

    const navbarBottom = fixNavbar.getBoundingClientRect().bottom;
    const aboutTop = aboutSection.getBoundingClientRect().top;

    // Calculate absolute distance and make sure it's a whole number
    const distance = Math.floor(Math.abs(aboutTop - navbarBottom));
	
	//log to check
	 //console.log('Distance About:', distance);

    // Check if the distance is less than a threshold
    if (distance < 300) {
        // Close to navbar: apply shaking and reset to smaller font size
        aboutTitle.classList.add('shakes');
        aboutTitle.style.fontSize = '1em'; // Normal size
    } else {
        // Far from navbar: enlarge and stop shaking
        aboutTitle.classList.remove('shakes');
        aboutTitle.style.fontSize = '1.5em'; // Enlarge font size
    }
}

// Trigger the font size and animation change on scroll
window.addEventListener('scroll', adjustAboutTitle);
</script>


