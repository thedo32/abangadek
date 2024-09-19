<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	
	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Halo Abang Adek Advertising, Saya $name tertarik untuk menanyakan detail lebih lanjut");

	?>

	<div class=h14> 
		Hubungi Kami
	</div>
	<div class=h10> 
		<a href="<?php echo $whatsappLink; ?>" target=_blank class="fa fa-whatsapp"></a><br>
		<a href="#" class="fa fa-instagram"></a><br>
		<a href="#" class="fa fa-facebook"></a><br>
	</div>
