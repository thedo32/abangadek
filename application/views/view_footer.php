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
                <li>&nbsp;<a href="<?php echo base_url('home');?>">Abang Adek <br>Advertising</a></li>
                <li>&nbsp;<a href="https://maps.app.goo.gl/DzxKDWupEZJ7bArA7" target="_blank">Jl. Limau Bali J 6 Lapai, <br>
				Kec. Nanggalo,<br>
				Padang, Sumbar</a></li>
                <li>&nbsp;<a href="<?php echo base_url('produk');?>">Produk</a></li>
				<ul class=wrapped-list-sm>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/printing');?>">&nbsp;Printing</a></li>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/interior');?>">&nbsp;Interior</a></li>
						<li><a style="color: #ffffff9e;" href="<?php echo base_url('produk/baliho');?>">&nbsp;Baliho</a></li>
				</ul>
			</ul>
		</td>
        <td style="vertical-align: top;">
           <ul class=wrapped-list> <!-- no link -->
                <li>&nbsp;&nbsp;Copyright: &copy;<script>document.write(new Date().getFullYear())</script></li>
				<li>&nbsp;&nbsp;Phone: 0751 - 444636</li>
				<li>&nbsp;&nbsp;Jam: 08:30 - 17:00<br>
				    Hari: Senin sd Sabtu</a></li>	 
		  </ul>
        </td>
		 <td style="vertical-align: top;">
			<?php $this->load->view("contact_us");?>
		</td>
    </tr>
	
</table>

</div>
</body>
</html>
