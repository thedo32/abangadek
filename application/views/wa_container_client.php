	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	$pesanan = $baliho->title;

	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk menanyakan tentang menjadi klien dari Abang Adek Advertising");

	?>

<br>
<div class=post-container-5>
		<div class=sidepostboxsmall><a href="<?php echo $whatsappLink; ?>" target=_blank>
			<img src="/storage/app/public/images/logo/walogo.png" alt="Cover Image">
		</a></div>
</div>
<br>
