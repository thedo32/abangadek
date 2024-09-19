<!-- Place the first <script> tag in your HTML's <head> -->
<script type="text/javascript" src="https://cdn.tiny.cloud/1/bmlmb5p14dr85225jial6a2am0m0m3vihfyzrbkwbe9n2mnf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


</head>  
<body class="bg-body">

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
	

    <div class=fix-navbar>
		<?php 
			$this->load->view("fix_logo");
			$this->load->view("fix_menu");
			//$this->load->view("header_slider");
			// $this->load->view('side_post');
		?>
	</div>			

    <!-- form action style for editing a user -->
	

    <form action="<?php echo base_url(uri_string()); ?>" method="post" enctype="multipart/form-data">
        <table class=login-table>
            <tr>
                <td>Title</td>
                <td><input type="text" size="50" name="title" value="<?php echo set_value('title', $news->title); ?>"></td>
            </tr>
            <tr>
                <td>Text</td>
                <td><textarea name="text"><?php echo set_value('text', $news->text); ?></textarea></td>
            </tr>
			<tr>
				<td>Image</td>
				<td><input type="file" name="cover"></td>
			</tr>
				<tr>
			<td>Produk</td>
            <td>
				<!-- Dropdown button -->
				<div class="dropdown">
					<button type="button" class="dropbtn">Pilih Produk</button>
					<div class="dropdown-content">
						<a href="#" onclick="selectProduct(event, 'Printing')">Printing</a>
						<a href="#" onclick="selectProduct(event, 'Interior')">Interior</a>
						<a href="#" onclick="selectProduct(event, 'Baliho')">Baliho</a>
					</div>
				</div>
				<!-- Text input to be filled by dropdown -->
				<input type="text" size="30" id="product-input" name="produk" value="<?php echo set_value('produk', $news->produk); ?>">
			</td>
		</tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save Edit"></td>
            </tr>
        </table>
    </form>
	
	<?php echo validation_errors(); ?>
	<br><br>

<script>
	imageClickable();
</script>
