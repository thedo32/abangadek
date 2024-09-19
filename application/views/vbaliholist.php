
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




	
