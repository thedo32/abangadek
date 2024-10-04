<style>
    /* For home link only */
    #homeLink {
        color: black !important;
        font-weight: bolder !important;
    }
    /* Styling for the active link */
    .active-link {
        color: red;
        font-weight: bolder;
        background-color: white;
        border-radius: 5px;
        border: none;
    }
</style>

<?php if ($this->session->userdata("name") === 'Alpha'): ?>
    <div class="fix-menu" style="width:100% !important; padding-left:200px !important;">
<?php else: ?>
    <div class="fix-menu">
<?php endif; ?>
        <nav class="navbar-expand-lg navbar-light">
            <button class="table navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="text-center navbar-nav mr-auto">
                    <?php if ($this->session->userdata("name") === 'Alpha'): ?>
                        <li class="nav-item">
                            <a id="homeLink" href="<?php echo base_url('home'); ?>">HOME</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="productLink" href="#product" class="nav-link" id="produkDropdown" style="color: white;">PRODUK</a>
                            <div class="dropdown-menu" aria-labelledby="produkDropdown">
                                <a id="printingLink" class="dropdown-item" href="<?php echo base_url('produk/printing'); ?>">PRINTING</a>
                                <a id="interiorLink" class="dropdown-item" href="<?php echo base_url('produk/interior'); ?>">INTERIOR</a>
                                <a id="balihoLink" class="dropdown-item" href="<?php echo base_url('produk/baliho'); ?>">BALIHO</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a id="clientLink" href="#client">CLIENT</a>
                        </li>
                        <li class="nav-item">
                            <a id="aboutLink" href="#about">TENTANG KAMI</a>
                        </li>
                        <li class="nav-item">
                            <a id="dashboardLink" href="<?php echo base_url('register'); ?>">USER DASHBOARD</a>
                        </li>
                        <li class="nav-item">
                            <a id="addUserLink" href="<?php echo base_url('register/add'); ?>">ADD USER</a>
                        </li>
                        <li class="nav-item">
                            <a id="addProdukLink" href="<?php echo base_url('news/add/produk'); ?>">ADD PRODUK</a>
                        </li>
                        <li class="nav-item">
                            <a id="addClientLink" href="<?php echo base_url('news/add/client'); ?>">ADD CLIENT</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('login/logout'); ?>">LOGOUT</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a id="homeLink" href="<?php echo base_url('home'); ?>">HOME</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="productLink" href="#product" class="nav-link" id="produkDropdown" style="color: white;">PRODUK</a>
                            <div class="dropdown-menu" aria-labelledby="produkDropdown">
                                <a id="printingLink" class="dropdown-item" href="<?php echo base_url('produk/printing'); ?>">PRINTING</a>
                                <a id="interiorLink" class="dropdown-item" href="<?php echo base_url('produk/interior'); ?>">INTERIOR</a>
                                <a id="balihoLink" class="dropdown-item" href="<?php echo base_url('produk/baliho'); ?>">BALIHO</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a id="clientLink" href="#client">CLIENT</a>
                        </li>
                        <li class="nav-item">
                            <a id="aboutLink" href="#about">TENTANG KAMI</a>
                        </li>
                        <li class="nav-item">
                            <a id="logLink" href="<?php echo base_url('login'); ?>">LOGIN</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
$(document).ready(function() {
    // Smooth Scroll for section links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href')); // Get the target section
        if (target.length) {
            event.preventDefault(); // Prevent default anchor behavior
            // Smooth scroll to the target section
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000); // Adjust the speed (1000 ms = 1 second)
        }

        // Collapse the navbar after clicking a menu link
        $('.navbar-collapse').collapse('hide');
    });

    // Function to highlight active link based on hash
    function highlightActiveLink() {
        $('a.nav-link').removeClass('active-link'); // Remove active class from all links
        var hash = window.location.hash;  // Get the current URL hash
        if (hash) {
            $('a[href="' + hash + '"]').addClass('active-link'); // Add active class to the clicked link
        }
    }

    // Call highlightActiveLink on page load and hash change
    $(window).on('load hashchange', highlightActiveLink);
});

// Active link handling based on current URL (non-hash URLs)
let currentUrl = window.location.pathname;

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

// Loop through the links and set the active link color if URL matches
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
