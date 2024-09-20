<style>
	/* for home link only*/
	#homeLink {
    color: black !important;
	font-weight:bolder !important;
}

</style>
<?php if ($this->session->userdata("name") === 'Alpha'):?>
	<div class=fix-menu style="width:100% !important; padding-left:200px !important;">
<?php else:?>
	<div class=fix-menu>
<?php endif; ?>
			<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>
     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="text-center navbar-nav mr-auto">
			<?php if ($this->session->userdata("name") === 'Alpha'):?>
				<li class="nav-item">
					<a id="homeLink" href="<?php echo base_url('home'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">HOME</a>
				</li>
				<li class="nav-item">
					 <a id="aboutLink" href="<?php echo base_url('about'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">TENTANG KAMI</a>
				</li>
				<li class="nav-item dropdown">
                        <!-- Allow the PRODUK link to be clicked and dropdown to show on hover -->
						<a id="productLink" href="<?php echo base_url('produk'); ?>" class="nav-link" id="produkDropdown" style="color: white; margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">
							PRODUK
						</a>
						<div class="dropdown-menu" aria-labelledby="produkDropdown">
							<a id="printingLink" class="dropdown-item" href="<?php echo base_url('produk/printing'); ?>" style="font-size:1em !important;">PRINTING</a>
							<a id="interiorLink" class="dropdown-item" href="<?php echo base_url('produk/interior'); ?>" style="font-size:1em !important;">INTERIOR</a>
							<a id="balihoLink" class="dropdown-item" href="<?php echo base_url('produk/baliho'); ?>" style="font-size:1em !important;">BALIHO</a>
						</div>
				</li>
				<li class="nav-item">
					<a id="clientLink" href="<?php echo base_url('client'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;" >CLIENT</a>
				</li>
				<li class="nav-item">
					<a id="dashboardLink" href="<?php echo base_url('register'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">USER DASHBOARD</a>
				</li>
				<li class="nav-item">
					<a id="addUserLink" href="<?php echo base_url('register/add'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">ADD USER</a>
				</li>
				<li class="nav-item">
					<a id="addProdukLink" href="<?php echo base_url('news/add/produk'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">ADD PRODUK</a>
				</li>
				<li class="nav-item">
					<a id="addClientLink" href="<?php echo base_url('news/add/client'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important;">ADD CLIENT</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('login/logout'); ?>" style="margin-right:5px !important; margin-left:5px !important; font-size:0.9em !important; margin-right:20px !important;">LOGOUT</a>
				</li>
			<?php else: ?>
				<li class="nav-item">
					<a id="homeLink" href="<?php echo base_url('home'); ?>">HOME</a>
				</li>
				<li class="nav-item">
					 <a id="aboutLink" href="<?php echo base_url('about'); ?>">TENTANG KAMI</a>
				</li>
				<li class="nav-item dropdown">
                        <!-- Allow the PRODUK link to be clicked and dropdown to show on hover -->
						<a id="productLink" href="<?php echo base_url('produk'); ?>" class="nav-link" id="produkDropdown" style="color: white;">
							PRODUK
						</a>
						<div class="dropdown-menu" aria-labelledby="produkDropdown">
							<a id="printingLink" class="dropdown-item" href="<?php echo base_url('produk/printing'); ?>">PRINTING</a>
							<a id="interiorLink" class="dropdown-item" href="<?php echo base_url('produk/interior'); ?>">INTERIOR</a>
							<a id="balihoLink" class="dropdown-item" href="<?php echo base_url('produk/baliho'); ?>">BALIHO</a>
						</div>
				</li>
				<li class="nav-item">
					<a id="clientLink" href="<?php echo base_url('client'); ?>" >CLIENT</a>
				</li>
				<li class="nav-item">
					<a id="logLink" href="<?php echo base_url('login'); ?>" >LOGIN</a>
				</li>
			<?php endif; ?>
			</ul>
			</div>
			</nav>
		</div>
	</div>
	
<script>
// Get the current URL path
let currentUrl = window.location.pathname;

// Define the link elements and corresponding URL paths
const links = {
    '/': document.getElementById('homeLink'),
    '/home': document.getElementById('homeLink'),
    '/about': document.getElementById('aboutLink'),
    '/produk': document.getElementById('productLink'),
    '/client': document.getElementById('clientLink'),
    '/register': document.getElementById('dashboardLink'),
    '/register/add': document.getElementById('addUserLink'),
	'/news/add/produk': document.getElementById('addProdukLink'),
	'/news/add/client': document.getElementById('addClientLink')
   
};

// Loop through the links and set the active link color if URL matches, excluding the 'home' link
for (const path in links) {
    if (links[path] && currentUrl.includes(path) && path !== '/home' && path !== '/') {
        links[path].style.color = 'red';  // Set the active link color
        links[path].style.fontWeight = 'bolder';  // Optionally, make the active link bold
        links[path].style.border = 'none';  // Explicitly remove the border
        links[path].style.borderRadius = '5px';  // Optionally, add border radius
        links[path].style.backgroundColor = 'white';  // Optionally, change the background color
    }
}


</script>




