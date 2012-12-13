<?php
	$title = get_post_meta($post->ID, "custom-title", true);
	if (get('auteur_atrabile')) {
?>

<img src="<?php echo get('image_head');?>" alt="" width="940" height="368" />


 <?php } else {  ?>

<img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/head_auteur_bn.jpg" alt="" width="940" height="368" />

 <?php } ?>
