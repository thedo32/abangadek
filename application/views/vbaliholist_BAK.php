
<!-- script for temporary notification -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Delay in milliseconds (e.g., 8000 ms = 8 seconds)
        var delay = 8000;

        // Hide the message after the delay
        setTimeout(function() {
            $('#addeditSuccessMessage').fadeOut(5000, function() {
                $(this).remove();
            });
        }, delay);
    });
</script>

<link rel="stylesheet" href="/extension/css/leaflet.legend.css" />
</head>

<body class="bg-body">
	<?php echo validation_errors(); ?>
    <div class=fix-navbar>
	<?php 
		$this->load->view("fix_logo"); 
		$this->load->view("fix_menu");
		  // $this->load->view('side_post');
	?>
	</div>

	<img src="/storage/app/public/images/slider/baliho.png" class=image-logo-center>

	<!-- notification if add or edit news success-->
    <?php if ($this->session->tempdata('add_success')): ?>
    <p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('add_success'); ?></p>
    <?php elseif ($this->session->tempdata('edit_success')): ?>
    <p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('edit_success'); ?></p>
    <?php endif; ?>

	<br>
	<table style="margin:20px !important; ">
	<tr>
		<h2>&nbsp;&nbsp;&nbsp;Peta Lokasi Baliho</h2>
	</tr>
	<tr>
		   <td>
				<!-- Dropdown button -->
				<div class="dropdown">
					<button type="button" class="dropbtn">Pilih Zoom Area</button>
					<div class="dropdown-content" style=z-index:2000 !important;>
						<a href="#" onclick="selectArea(event, 'Padang', [-0.9491813292632251, 100.36379707549786],11)">Padang</a>
						<a href="#" onclick="selectArea(event, 'Painan',[-1.391750740941613, 100.62999963749682],12)">Painan</a>
						<a href="#" onclick="selectArea(event, 'Padang Pariaman',[-0.662043439539266, 100.25121899040526],11)">Pdg Pariaman</a>
						<a href="#" onclick="selectArea(event, 'Tanah Datar',[-0.5294974719068765, 100.52315464712437],11)">Tanah Datar</a>
						<a href="#" onclick="selectArea(event, 'Payakumbuh', [-0.22544051421407338, 100.63168469369624],12)">Payakumbuh</a>
						<a href="#" onclick="selectArea(event, 'Bukittinggi', [-0.2997614849058326, 100.38355565605849],12)">Bukittinggi</a>
						<a href="#" onclick="selectArea(event, 'Solok', [-0.777386053571656, 100.65496759986982],12)">Solok</a>
						<a href="#" onclick="selectArea(event, 'Kab Solok', [-0.924210042894259, 100.72148290222962],11)">Kab. Solok</a>
					</div>
				</div>
				<!-- Text input to be filled by dropdown -->
				<input type="text" size="30" id="area-input" name="area" value="<?php echo set_value('produk'); ?>">
			</td>
	</tr>
	</table>

	<?php 
		// $this->load->view("fix_legend"); 
	?>

    <!-- Map container -->
    <div id="map" style="height: 600px; width: 95%; margin:auto; font-size:1.5em;">
	
	</div>

    <!-- Leaflet JS plugin -->
    <script src="<?php echo base_url('extension/js/leaflet.js'); ?>"></script>
	<script src="<?php echo base_url('extension/js/leaflet.legend.js'); ?>"></script>

	
	<script>
    // Initialize the map and set its default map center and zoom
    var map = L.map('map').setView(selectedCoord, 12);

	var openStreetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '© OpenStreetMap contributors'
		});

	var openTopoMapLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
		attribution: '© OpenTopoMap contributors'
	});

	var openStreetMapHOTLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});
	
	var mapBoxLayerStreet = L.tileLayer('https://api.mapbox.com/v4/mapbox.mapbox-streets-v8/12/1171/1566.mvt?style=mapbox://styles/mapbox/streets-v12@00&access_token=pk.eyJ1IjoidGhlZG8zMiIsImEiOiJjbHMxbGRvaDEwYm5yMmtxeGZjenJ1ZnplIn0.HrgG-gRUV-3r4A0qv_Ozaw');
	
	var mapBoxLayerRaster = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoidGhlZG8zMiIsImEiOiJjamZzYTVlcWIwMGQ5Mnpxbm53N3BpOWI4In0.HjdiCmE4JWMx5QMNNA-ciQ', {
		tileSize: 256,   // standard tile size
		zoomOffset: 0,   // no offset for standard tiles
		maxZoom: 20      // you can set the maximum zoom level as needed
	});


    // Load and display tile layers on the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

	// legend
	 L.control.Legend({
			collapsed:true,       
			opacity: 0.3,
			position: "topleft",
			symbolWidth: 100,
			symbolHeight: 100,
			title: "Legenda:",
			legends: [{
                label: "Baliho Satu Sisi",
				type: "image",
                url: "/icon/icon-marker.png",
            },
			{
                label: "Baliho Dua Sisi",
                type: "image",
				url: "/icon/icon-marker-first.png",
            }
			]
        }).addTo(map);

	//layer control
		
	// Base layers (for switching between maps)
	var baseLayers = {
		"Open Street Map": openStreetMapLayer,
		"Open Street Map HOT": openStreetMapHOTLayer,
		"Open Topo Map": openTopoMapLayer,
		"Map Box Street": mapBoxLayerStreet,
		"Map Box Raster": mapBoxLayerRaster,
	};

	// Add the layer control to the map
	L.control.layers(baseLayers).addTo(map);

     // Declare default icon outside the loop
    let icon1;
	

    // Loop through the baliho list in PHP and place markers dynamically
    <?php if (is_array($baliho_all)): ?>
        <?php foreach ($baliho_all as $baliho_map): ?>
            var coordinate = "<?php echo $baliho_map['coordinate']; ?>".split(","); // Split the coordinate string into [latitude, longitude]
            var title = "<?php echo $baliho_map['title']; ?>"; // Get the title for popup
             var url = '<a href="<?php echo site_url('baliho/view/' . $baliho_map['slug']); ?>" title="<?php echo $baliho_map['title']; ?>">' +
                  '<img src="<?php echo base_url($baliho_map['cover']); ?>" target="_blank" height="240" width="300" class="news-imgthumb"></a>'; // Image with 200x160 title for popup
			var popupContent = "<b>" + title + "</b><br><br>" + url +"<br><br>";

			

		// Change icon based on title containing "2S-1" or "2S-2"
		if (title.includes("2S-1")) {
			// Set icon for 2S-1
			icon1 = L.icon({
				iconUrl: '<?= base_url('icon/icon-marker-first.png'); ?>',
				iconSize: [108, 60],   // size of the icon
				iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
				popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
			});
		} else if (title.includes("2S-2")) {
			// Set icon for 2S-2
			icon1 = L.icon({
				iconUrl: '<?= base_url('icon/icon-marker-second.png'); ?>',
				iconSize: [108, 60],   // size of the icon
				iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
				popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
			});
		}else { 
			//default
			icon1 = L.icon({
				iconUrl: '<?= base_url('icon/icon-marker.png'); ?>',
				iconSize: [108, 60],   // size of the icon
				iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
				popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
			});
		}


            // Place a marker on the map with the coordinates from $baliho_map['coordinate']
            L.marker([parseFloat(coordinate[0]), parseFloat(coordinate[1])], {icon: icon1})
                .bindTooltip(title, {direction: 'top'})
				.bindPopup(popupContent)
                .addTo(map);
        <?php endforeach; ?>
    <?php endif; ?>
</script>

<br>

   
  
        <div>
            <div class=table-responsive>
				<?php if ($this->session->userdata("name") === 'Alpha'):?>

                <table class=admin-table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($baliho)): ?>
                        <?php foreach ($baliho as $baliho_list): ?>
                        <tr>
                            <td>
                               <a href="<?php echo site_url('baliho/view/' . $baliho_list['slug']); ?>"><?php echo $baliho_list['title']; ?></a>
                            </td>
                            <td><?php echo character_limiter($baliho_list['text'],30); ?></td>
                            <td>
                                <a href="<?php echo site_url('news/edit/produk/' . $baliho_list['id']); ?>">Edit</a><p>
                                <a href="<?php echo site_url('news/delete/produk/' . $baliho_list['id']); ?>" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4">No news available.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php else: ?>

                <table class=news-table>
                    <tbody>					  
                        <?php if (is_array($baliho)): ?>
                        <tr>
							 <?php foreach ($baliho as $index => $baliho_list): ?>
								<td>
									<div class="newsbox">
										 <div class="md-title"><a href="<?php echo site_url('baliho/view/' . $baliho_list['slug']); ?>" title="<?php echo $baliho_list['title']; ?>"><?php echo $baliho_list['title']; ?></a></div><br>
										 <a href="<?php echo site_url('baliho/view/' . $baliho_list['slug']); ?>" data-toggle="tooltip" title="<?php echo $baliho_list['title']; ?>"><img src= "<?php echo base_url($baliho_list['cover']);?>" height="280" width="280" class=news-imgthumb ></a>
										 <div class="sm-title"><?php echo character_limiter($baliho_list['text'], 5); ?></div>
									</div>
								</td>
								<?php if ($index % 2 != 0): ?>
									</tr><tr>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
                        <?php else: ?>
                        <tr>
                            <td colspan="4">No news available.</td>
                        </tr>
                        <?php endif; ?>
					  
                    </tbody>
                </table>
				<?php endif; ?>
            </div>
        </div>
    
	<br>
    <?php echo $this->pagination->create_links(); 
	?>
	<br>
	<br>

<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>

    <script>
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

	// for expand and collapse below navbar
	 shiftBelowImgCenter();
	 imageClickable();
    </script>
