<script> 

// Run the function when the page loads
window.onload = adjustFooterPosition;

// Run the function whenever the window is resized
window.onresize = adjustFooterPosition;
</script>

   <br><br><br><br>
   <div class=shadowfooter>
	<table style="width:100%;">
    <tr>
        <td style="vertical-align: top;">
            <ul class=wrapped-list>
                <li>&nbsp;<a href="<?php echo base_url('home');?>">Abang Adek <br>Advertising &copy;<script>document.write(new Date().getFullYear())</script></a></li>
                <li>&nbsp;<a href="https://maps.app.goo.gl/DzxKDWupEZJ7bArA7" target="_blank">Jl. Limau Bali J 6 Lapai, <br>
				Kec. Nanggalo,<br>
				Padang, Sumbar<br>
				Tlp: 0751-444636<br>
				Senin-Sabtu 08:30-17:00</a></li>	
				<li>&nbsp;<a href="<?php echo base_url('produk');?>">Produk</a></li>
				<ul class=wrapped-list-sm>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/printing');?>">&nbsp;Printing</a></li>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/interior');?>">&nbsp;Interior</a></li>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/baliho');?>">&nbsp;Baliho</a></li>
				</ul>
			</ul>
		</td>
        <td style="vertical-align: top;">
		<a style="margin-left:20% !important; font-size:1.3em !important;" href="https://maps.app.goo.gl/JxVw9gtAR1Hgq4ba9" target="_blank">Klik Di Sini Untuk Lihat Peta</a>
       	<div class=post-container-map>
		    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d997.3308637947259!2d100.3594215!3d-0.9024206!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8ba87c16e81%3A0xbc3c5353edbd8997!2sAbang%20adek%20advertising!5e0!3m2!1sen!2sid!4v1726112265229!5m2!1sen!2sid" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>
        </div>
			<img src="/storage/app/public/images/logo/member.jpg" class="members">
		</td>
		 <td style="vertical-align:top;">
			<?php $this->load->view("contact_us");?><br>
		 </td>
    </tr>
	
</table>

</div>
</body>
</html>
