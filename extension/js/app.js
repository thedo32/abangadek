// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		mybutton.style.display = "block";
	} else {
		mybutton.style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}



// Function to show the current slide based on index
function showSlides(n) {
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");

	if (n > slides.length) { slideIndex = 1 }
	if (n < 1) { slideIndex = slides.length }

	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  // Hide all slides
	}

	for (var i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", ""); // Remove active class from all dots
	}

	slides[slideIndex - 1].style.display = "block";  // Show the current slide
	dots[slideIndex - 1].className += " active";     // Add "active" class to the current dot
}

// Function to handle next/prev button clicks
function plusSlideHead(n) {
	showSlides(slideIndex += n);
}

// Auto slide every 10 seconds
setInterval(function () {
	plusSlideHead(1);  // Automatically move to the next slide every 10 seconds
}, 10000);




//function for pop_up_slider
function showSlidesPop() {
	for (var i = 0; i < slidesPop.length; i++) {
		slidesPop[i].style.display = "none";
	}
	slidePopIndex++;
	if (slidePopIndex > slidesPop.length) { slidePopIndex = 1 }
	fadeInOut(slidesPop[slidePopIndex - 1]);
	setTimeout(showSlidesPop, 10000); // Change image every 10 seconds
}

function currentSlidePop(n) {
	slidePopIndex = n;
	showSlidePop(slidePopIndex);
}

function showSlidePop(n) {
	if (n > slidesPop.length) { slidePopIndex = 1 }
	if (n < 1) { slidePopIndex = slidesPop.length }
	for (var i = 0; i < slidesPop.length; i++) {
		slidesPop[i].style.display = "none";
	}
	fadeInOut(slidesPop[slidePopIndex - 1]);
}

function plusSlidesPop(n) {
	showSlidePop(slidePopIndex += n);
}




//function for image_slider
function fadeInOut(element) {
	var opacity = 0; // Start at 0 for fade in
	var scale = 0.85; // Start at 85% scale
	var interval = 10; // Interval for smoother transition
	var duration = 8000; // 8 seconds for fade in and scale transition

	element.style.opacity = opacity;
	element.style.transform = `scale(${scale})`; // Initial scale
	element.style.display = "block";

	var fadeInOutTimer = setInterval(function () {
		if (opacity >= 0.8 && scale >= 1) { // Target opacity and scale
			clearInterval(fadeInOutTimer);
			setTimeout(function () {
				fadeOut(element); // Trigger fade-out after 5 seconds
			}, 5000); // Hold the image for 5 seconds before fading out
		}
		element.style.opacity = opacity;
		element.style.transform = `scale(${scale})`; // Apply scale
		opacity += (0.8 - 0) / (duration / interval); // Fade in from 0 to 0.8
		scale += (1 - 0.85) / (duration / interval); // Scale from 0.85 to 1
	}, interval);
}

function fadeOut(element) {
	var opacity = 0.8; // Start at 0.8 for fade out
	var scale = 1;     // Start at full scale
	var interval = 10; // Interval for smoother transition
	var duration = 8000; // 8 seconds for fade-out and scale-down

	var fadeOutTimer = setInterval(function () {
		if (opacity <= 0 && scale <= 0.85) { // Target opacity and scale
			clearInterval(fadeOutTimer);
			element.style.display = "none";
			showNextSlide(); // Only show next slide after fade-out is complete
		}
		element.style.opacity = opacity;
		element.style.transform = `scale(${scale})`; // Scale down gradually
		opacity -= (0.8 - 0) / (duration / interval); // Fade out from 0.8 to 0
		scale -= (1 - 0.85) / (duration / interval);  // Scale down from 1 to 0.85
	}, interval);
}


function showSlidesImg() {
	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	slideImgIndex++;
	if (slideImgIndex > slides.length) { slideImgIndex = 1 }
	fadeInOut(slides[slideImgIndex - 1]); // Fade in new image
}

function showNextSlide() {
	slideImgIndex++;
	if (slideImgIndex > slides.length) { slideImgIndex = 1 }
	fadeInOut(slides[slideImgIndex - 1]); // Fade in new image after fade-out
}

function currentSlide(n) {
	slideImgIndex = n;
	showSlideImg(slideImgIndex);
}

function showSlideImg(n) {
	if (n > slides.length) { slideImgIndex = 1 }
	if (n < 1) { slideImgIndex = slides.length }
	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	fadeInOut(slides[slideImgIndex - 1]); // Fade in specific image
}

function plusSlides(n) {
	showSlideImg(slideImgIndex += n);
}




// for expand and collapse below navbar slide
function shiftBelowSlide() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var slideShow = document.querySelector('.slideshow-container');
		var containerImg = document.querySelector('.slideshow-container-img');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				slideShow.style.marginTop = '150px';
				containerImg.style.marginTop = '150px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				slideShow.style.marginTop = 270 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				containerImg.style.marginTop = 270 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

function shiftBelowImgCenter() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var slideShow = document.querySelector('.image-logo-center');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				slideShow.style.marginTop = '110px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				slideShow.style.marginTop = 270 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

function shiftBelowContainers() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var containerS = document.querySelector('.containers');
		var containerImg = document.querySelector('.slideshow-container-img');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				containerS.style.marginTop = 0;
				containerImg.style.marginTop = 0;
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				containerS.style.marginTop = 270 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				containerImg.style.marginTop = 270 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

// for expand and collapse below navbar table
function shiftBelowRTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var readTable = document.querySelector('.read-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				readTable.style.marginTop = '200px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				readTable.style.marginTop = 300 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

function shiftBelowRgTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var regTable = document.querySelector('.reg-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				regTable.style.marginTop = '200px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				regTable.style.marginTop = 300 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}


function shiftBelowLTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var loginTable = document.querySelector('.login-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				loginTable.style.marginTop = '200px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				loginTable.style.marginTop = 350 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

function shiftBelowHTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var homeTable = document.querySelector('.home-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				homeTable.style.marginTop = '200px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				homeTable.style.marginTop = 300 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

function shiftBelowUTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var userTable = document.querySelector('.user-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');
		var dropMenu = document.querySelector('.dropdown-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				userTable.style.marginTop = '200px';
				fixMenu.style.fontSize = '1em';
				dropMenu.style.fontSize = '1em';
			} else {
				userTable.style.marginTop = 310 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '2em';
				dropMenu.style.fontSize = '1em';
			}
		});
	});
}

//adjust footer position
function adjustFooterPosition() {
	var footer = document.querySelector('.shadowfooter');
	var bodyHeight = document.body.offsetHeight;
	var windowHeight = window.innerHeight;

	if (bodyHeight < windowHeight) {
		footer.style.position = 'absolute';
		footer.style.bottom = '0';
	} else {
		footer.style.position = 'relative';
		footer.style.bottom = 'auto';
	}
}


///for clickable image
function imageClickable(){
	const img = new Image();
	img.src = '/storage/app/public/images/logo/logo-abangadek.png'; // Replace with your image path

	img.onload = function () {
		// Draw the image on a canvas
		const canvas = document.getElementById('imageCanvas');
		const ctx = canvas.getContext('2d');

		// Set canvas dimensions to match the image
		canvas.width = img.width;
		canvas.height = img.height;

		// Draw image onto the canvas
		ctx.drawImage(img, 0, 0);

		// Add click event to detect transparency
		canvas.addEventListener('click', function (event) {
			// Get the click coordinates
			const rect = canvas.getBoundingClientRect();
			const x = event.clientX - rect.left;
			const y = event.clientY - rect.top;

			// Get the pixel data at the clicked location
			const pixel = ctx.getImageData(x, y, 1, 1).data;

			// Check the alpha value (pixel[3]) to see if it's transparent
			if (pixel[3] !== 0) {
				window.location.href = '/'; //go to homepage
			}
		});

		// Enable pointer-events only for non-transparent pixels
		canvas.style.pointerEvents = 'auto'; // Enable pointer-events

	}
}


// for pop up image
document.addEventListener('DOMContentLoaded', function () {
	var popup = document.getElementById('popup');
	var closeButton = document.getElementById('close-button');

	closeButton.onclick = function () {
		popup.style.display = 'none';
	}

	window.onclick = function (event) {
		if (event.target == popup) {
			popup.style.display = 'none';
		}
	}
});


// Function to handle dropdown selection
function selectProduct(event, product) {
	event.preventDefault();  // Prevent page jump
	document.getElementById('product-input').value = product;  // Set the product value in input
}

