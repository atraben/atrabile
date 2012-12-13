<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		
		wp_title( '-', true, 'right' );
		
		// Add the blog name.
		bloginfo( 'name' );
		
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " - $site_description";
		
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		
		?></title>
		
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- mobile optimized -->
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!-- IE6 toolbar removal -->
		<meta http-equiv="imagetoolbar" content="false" />
		<!-- allow pinned sites -->
		<meta name="application-name" content="<?php bloginfo('name'); ?>" />
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

		<!-- default stylesheet -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/normalize.css">		
		
<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic|Chivo:900italic,900' rel='stylesheet' type='text/css'>
		
		<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script>window.jQuery || document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>

		<!-- modernizr -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/modernizr.full.min.js"></script>
	
<!--	<script src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.column-1.0.js"></script>
		
		<script>
		
		(function ($) {
			$( function() {
				$('.livre-content p').column({
//					width: 'auto',    // Default, this line is redundant.
  					count: 2,         // Spread over 4 columns.
// 					gap: 10,        // Space columns 20 pixels apart.
//  				rule_style: 'dotted',  // Show a dotted rule between columns.
//  				rule_width: 'thin',    // Set width of rule to 'thin' (usually 1 pixel).
//					rule_color: '#ccc',    // Set color of rule to a light gray.
//					split: 'sentence' // Keeps sentences together.
				});
			});		
		}(jQuery));
		
			</script>
		-->
		
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.columnizer.js"></script>

<script>

(function ($) {
	$(function(){
		$('.livre-content').columnize({
				columns: 2,
				lastNeverTallest: true,
//				doneFunc: function(){
//					$('.first.column').css("width", "222px");
//					$('.last.column').css("width", "222px");
//					
//			}
				
				manualBreaks:true
 			});
	});
}(jQuery));

	</script>
		
				<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<!-- jqform stylesheet -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/jqtransform.css">	
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
		<!--[if lt IE 9]>
    		<!-- ie stylesheet -->
    		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/ie.css">	
		<![endif]-->
		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header role="banner" id="banner">
			
				<div id="inner-header" class="wrap clearfix">
					<h1><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name');
					?></a></h1>
					<h2><?php bloginfo('description');
					?></h2>


<?php 

if ( is_home () || is_page('Atrabile') || in_category('news') ) { 

		 get_template_part( 'head', 'home' ); 

// } elseif ( in_category('news') ) { 
//
//		 get_template_part( 'head', 'home' ); 
//
//} elseif ( is_page('Atrabile') ) { 
//
//		 get_template_part( 'head', 'home' ); 
//		
 } else { 

		 get_template_part( 'head', 'single' ); 

 } ?>



					<nav role="navigation" class="menu">
						<ul id="menu">
							<li>
								<a href="<?php echo get_option('home'); ?>" rel="bookmark" title="Acceuil du site ATRABILE">Accueil</a>
							</li>
							<?php wp_nav_menu( array( 'items_wrap' => '%3$s', 'container' => false ) ); ?>
							<!--<?php wp_list_categories('orderby=id&depth=1&title_li='); ?><?php wp_list_pages('title_li=');?>-->
						</ul>
					</nav>
					<div class="headerborder"></div>
				</div>
				<!-- end #inner-header -->
			
			</header> <!-- end header -->
