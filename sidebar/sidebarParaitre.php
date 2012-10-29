<aside id="sidebar" class="clearfix" role="complementary">
	<?php
	
	// Get the ID of a given category - Tous les livres
	$category_id = get_cat_ID( 'livres' );

	// Get the URL of this category
	$category_link = get_category_link( $category_id );
	?>

	<!-- Print a link to this category -->
	<span class="liens-livres"><a href="<?php echo $category_link;?>" title="Tous les livres">Tous les livres</a></span>
	<br />
	<?php
	global $post;
	foreach (get_the_tags($post->ID) as $tag) {

		echo '<a href="' . get_option('home') . '/tag/' . $tag -> slug . '/" rel="tag">';
		echo 'Tous les livres de ' . $tag -> name . '<br />';
		echo '</a>';

	}
	?>

	<?php
	// Get the ID of the first given category - Tous les livres de la collection
	$cat = get_the_category();
	$cat = $cat[0];

	// Get the URL of this category
	$category_link2 = get_category_link($cat);
	?>

	<!-- Print a link to this category -->
	<span class="liens-livres"><a href="<?php echo $category_link2;?>" title="Tous les livres de la collection">Tous les livres de la collection</a></span>
	
</aside>
