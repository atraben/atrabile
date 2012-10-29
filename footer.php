<div class="clear"></div>
<div class="push"></div>
</div> <!-- end #container -->
<footer id="footer">
	<div id="footer_info">
		<p class="atrafoot">
			<img src="<?php echo get_template_directory_uri();?>/library/images/atrabile.gif" width="185" height="40" alt="Atrabile" />
			<br />
			CASE POSTALE 30 | 1211 GENEVE 21 | SUISSE
			<br />
			editions[at]atrabile.org
		</p>
		<div class="newsubscribe clearfix">
			<h4>Inscription à la newsletter</h4>
			<?php $wpMail = new wpMail();?>
			<?php $wpMail -> hardcoded(3);?>
		</div>
	</div>
</footer>
<!-- end footer -->
<!-- scripts are now optimized via Modernizr.load -->
<script src="<?php echo get_template_directory_uri();?>/library/js/scripts.js"></script>
<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<?php wp_footer();
	// js scripts are inserted using this function
?>

</body>

</html>