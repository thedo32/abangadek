
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

<!-- script legend style -->
<link rel="stylesheet" href="/extension/css/leaflet.legend.css" />
<link rel="stylesheet" href="/extension/css/leaflet.fullscreen.css" />

<!-- tom tom traffic map --non active style
<meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/maps/maps.css" />
  <link rel="stylesheet" type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.23.1//SearchBox.css" />
  <link rel="stylesheet" type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/maps/css-styles/traffic-incidents.css" />
  <link rel="stylesheet" type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/maps/css-styles/routing.css" />
  <link rel="stylesheet" type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/maps/css-styles/poi.css" />
  <link rel="stylesheet" type="text/css" href="/extension/css/styles.css" />
 end of tom tom traffic map -->


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
						<a href="#" onclick="selectArea(event, 'Painan',[-1.391750740941613, 100.62999963749682],11)">Painan</a>
						<a href="#" onclick="selectArea(event, 'Padang Pariaman',[-0.662043439539266, 100.25121899040526],11)">Pdg Pariaman</a>
						<a href="#" onclick="selectArea(event, 'Tanah Datar',[-0.5294974719068765, 100.52315464712437],11)">Tanah Datar</a>
						<a href="#" onclick="selectArea(event, 'Payakumbuh', [-0.22544051421407338, 100.63168469369624],11)">Payakumbuh</a>
						<a href="#" onclick="selectArea(event, 'Bukittinggi', [-0.2997614849058326, 100.38355565605849],11)">Bukittinggi</a>
						<a href="#" onclick="selectArea(event, 'Solok', [-0.777386053571656, 100.65496759986982],11)">Solok</a>
						<a href="#" onclick="selectArea(event, 'Kab Solok', [-0.924210042894259, 100.72148290222962],11)">Kab. Solok</a>
					</div>
				</div>
				<!-- Text input to be filled by dropdown -->
				<input type="text" size="30" id="area-input" name="area" value="<?php echo set_value('produk'); ?>">
			</td>
			<td>&nbsp;&nbsp;Klik Di Kanan Atas Peta Untuk Fullscreen </td>
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
<script src="<?php echo base_url('extension/js/leaflet.fullscreen.min.js'); ?>"></script>

<script>
// Initialize the map and set its default map center and zoom
var map = L.map('map').setView(selectedCoord, 12);


map.addControl(new L.Control.Fullscreen({
    title: {
        'false': 'View Fullscreen',
        'true': 'Exit Fullscreen'
    },
	position: "topright",
}));

// Define tile layers
var openStreetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '© OpenStreetMap contributors'
}).addTo(map); // Adding OpenStreetMap by default

var openTopoMapLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
	attribution: '© OpenTopoMap contributors'
});

var openStreetMapHOTLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
	attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
});

//var mapBoxLayerStreet = L.tileLayer('https://api.mapbox.com/v4/mapbox.mapbox-streets-v8/12/1171/1566.mvt?style=mapbox://styles/mapbox/streets-v12@00&access_token=pk.eyJ1IjoidGhlZG8zMiIsImEiOiJjamZzYTVlcWIwMGQ5Mnpxbm53N3BpOWI4In0.HjdiCmE4JWMx5QMNNA-ciQ');

var mapBoxLayerRaster = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoidGhlZG8zMiIsImEiOiJjamZzYTVlcWIwMGQ5Mnpxbm53N3BpOWI4In0.HjdiCmE4JWMx5QMNNA-ciQ', {
	tileSize: 256,
	zoomOffset: 0,
	maxZoom: 20
});

var tomTomLayer = L.tileLayer();

// Legend control
L.control.Legend({
	collapsed: true,
	opacity: 0.3,
	position: "bottomleft",
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

// Base layers (for switching between maps)
var baseLayers = {
	"Open Street Map": openStreetMapLayer,
	"Open Street Map HOT": openStreetMapHOTLayer,
	"Open Topo Map": openTopoMapLayer,
	//"Map Box Street": mapBoxLayerStreet,
	"Map Box Raster": mapBoxLayerRaster,
	"Tom Tom Layer (For Traffic)": tomTomLayer
};


    // Declare default icon outside the loop
// Create LayerGroup for both 2S-1 and 2S-2 combined
var twoSLayer = L.layerGroup();  // Layer for both 2S-1 and 2S-2 markers
var defaultLayer = L.layerGroup();  // Layer for default markers

// Declare default icon outside the loop
let icon1;

// Loop through the baliho list in PHP and place markers dynamically
<?php if (is_array($baliho_all)): ?>
    <?php foreach ($baliho_all as $baliho_map): ?>
        var coordinate = "<?php echo $baliho_map['coordinate']; ?>".split(","); // Split the coordinate string into [latitude, longitude]
        var title = "<?php echo $baliho_map['title']; ?>"; // Get the title for popup
        var url = '<a href="<?php echo site_url('baliho/view/' . $baliho_map['slug']); ?>" title="<?php echo $baliho_map['title']; ?>">' +
                  '<img src="<?php echo base_url($baliho_map['cover']); ?>" target="_blank" height="240" width="300" class="news-imgthumb"></a>'; // Image with 200x160 title for popup
        var popupContent = "<b>" + title + "</b><br><br>" + url + "<br><br>";

        // Change icon based on title containing "2S-1" or "2S-2"
        if (title.includes("2S-1")) {
            // Set icon for 2S-1
            icon1 = L.icon({
                iconUrl: '<?= base_url('icon/icon-marker-first.png'); ?>',
                iconSize: [108, 60],   // size of the icon
                iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });
            
            // Add to 2S LayerGroup (aggregated for 2S-1 and 2S-2)
            L.marker([parseFloat(coordinate[0]), parseFloat(coordinate[1])], {icon: icon1})
                .bindTooltip(title, {direction: 'top'})
                .bindPopup(popupContent)
                .addTo(twoSLayer);

        } else if (title.includes("2S-2")) {
            // Set icon for 2S-2
            icon1 = L.icon({
                iconUrl: '<?= base_url('icon/icon-marker-second.png'); ?>',
                iconSize: [108, 60],   // size of the icon
                iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });
            
            // Add to 2S LayerGroup (aggregated for 2S-1 and 2S-2)
            L.marker([parseFloat(coordinate[0]), parseFloat(coordinate[1])], {icon: icon1})
                .bindTooltip(title, {direction: 'top'})
                .bindPopup(popupContent)
                .addTo(twoSLayer);

        } else { 
            // Set default icon for other markers
            icon1 = L.icon({
                iconUrl: '<?= base_url('icon/icon-marker.png'); ?>',
                iconSize: [108, 60],   // size of the icon
                iconAnchor: [10, 50],  // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            // Add to default LayerGroup
            L.marker([parseFloat(coordinate[0]), parseFloat(coordinate[1])], {icon: icon1})
                .bindTooltip(title, {direction: 'top'})
                .bindPopup(popupContent)
                .addTo(defaultLayer);
        }
    <?php endforeach; ?>
<?php endif; ?>

// Add the layers to the map (optional to show by default)
twoSLayer.addTo(map);
defaultLayer.addTo(map);

// Layer control to toggle between 2S markers (aggregated) and default markers
var overlayMaps = {
    "Baliho 1 Sisi": defaultLayer,
	"Baliho 2 Sisi": twoSLayer
};

// Add the ALL layer control to the map
L.control.layers(baseLayers, overlayMaps, {position: "topleft"}).addTo(map);

</script>

<br>
<!-- Tom Tom Traffic Map -->
<div class="container" style="margin-left: 2%;">
    <div class="row align-items-center mt-2">
        <!-- Logo -->
        <div class="col">
            <h5>Traffic Di Suatu Area:</h5>
        </div>

        <!-- Location Selector -->
        <div class="col">
            <div id="search-panel-container" class="row">
                <div id="search-panel" class="pb-4"></div>
            </div>
        </div>

        <!-- Traffic Layers Toggle -->
        <div class="col">
			<div class="row">
                <div class="col d-flex align-items-center">
                    <img style="width:50px !important;" src="/icon/traffic-flow.png" alt="" />
                    <label for="flow-toggle" class="traffic-text ml-2">Arus Lalulintas</label>
                    <label class="switch ml-2">
                        <input id="flow-toggle" type="checkbox" />
                        <span class="toggle round"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex align-items-center">
                    <img style="width:50px !important;"  src="/icon/traffic-flows.png" alt="" />
                    <label for="incidents-toggle" class="traffic-text ml-2">Peristiwa Lalin</label>
                    <label class="switch ml-2">
                        <input id="incidents-toggle" type="checkbox" />
                        <span class="toggle round"></span>
                    </label>
                </div>
            </div>
        </div>
		&nbsp;
        <!-- Speed Intervals -->
        <div class="col">
            <span class="show-traffic-layers">Interval Kecepatan</span>
            <div class="row">
                <div class="col-auto">
                    <span class="legend-font">0 - 0.01</span>
                </div>
		        <div class="col-auto">
                    <span class="legend-font">1</span>
                </div>
            </div>
            <div class="row">
				&nbsp;&nbsp;
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: #6e6e6e;"></div>
                </div>
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: rgba(245, 8, 2, 0.5);"></div>
                </div>
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: #ff2323;"></div>
                </div>
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: #fad900;"></div>
                </div>
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: #ffff37;"></div>
                </div>
                <div class="col-auto">
                    <div class="row border py-2" style="background-color: #2bc82b;"></div>
                </div>
            </div>
        </div>

        <!-- Bounding Box Button -->
        <div class="col">
            <button id="bounding-box-button" type="button" class="btn my-2">
                BOUNDING INCIDENTS
            </button>
        </div>
    </div>
</div>

 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.1/bootstrap-slider.min.js"></script>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/maps/maps-web.min.js"></script>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.57.0/services/services-web.min.js"></script>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.23.1/SearchBox-web.js"></script>

 <script src="<?php echo base_url('extension/js/traffic.js'); ?>"></script>

<!-- end of tom tom map -->


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
	  shiftBelowElements(".image-logo-center", 110, 270, 1, 2);
	 imageClickable();
    </script>
