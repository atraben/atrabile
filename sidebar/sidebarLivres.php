<aside id="sidebar" class="clearfix" role="complementary">
	<?php

	if (is_single() && in_category('bilenoire'))
	{

    // Get the ID of a given category - Tous les livres
    $category_id = get_cat_ID('livres');

    // Get the URL of this category
    $category_link = get_category_link($category_id);

	?>
	<!-- Print a link to this category --><span class="liens-livres"><a href="<?php echo $category_link;?>" title="Tous les livres">Tous les livres</a></span>
	
	<?php
	// Get the ID of the first given category - Tous les Bile Noire
	$cat = get_the_category();
	$cat = $cat[0];

	// Get the URL of this category
	$category_link2 = get_category_link($cat);
	?>
	<!-- Print a link to this category --><span class="liens-livres"><a href="<?php echo $category_link2;?>" title="Tous les livres de la collection">Tous les Bile Noire</a></span>
	
	<?php
	}
	elseif (is_single())
	{

	// Get the ID of a given category - Tous les livres
	$category_id = get_cat_ID('livres');

	// Get the URL of this category
	$category_link = get_category_link($category_id);
	?>
	<!-- Print a link to this category --><span class="liens-livres"><a href="<?php echo $category_link;?>" title="Tous les livres">Tous les livres</a></span>
	
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
	<!-- Print a link to this category --><span class="liens-livres"><a href="<?php echo $category_link2;?>" title="Tous les livres de la collection">Tous les livres de la collection</a></span>
	
	<?php
	}
	?>
	<?php
	if (is_single())
	{
	$catposts = query_posts('cat=4,5&meta_key=serie&meta_value=1');
	if ($catposts)
	{
	foreach ($catposts as $post)
	{
	setup_postdata($post);
	?>
	<ul>
		
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title();?>"> <?php
		the_title('<li><span class="autre-serie">', ' </span>');
		?></a>
		| <span class="temps"> <?php
		the_time('F Y');
			?>
		</span>
	</ul>
	<?php
	}
	}
	}
	?>
</aside>
