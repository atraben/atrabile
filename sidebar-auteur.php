<aside id="sidebar" role="complementary">
	<?php if ( in_category( 'auteurs' ) && is_single() ) {
	?>
	<ul class="auteurs-archive">
		<?php
			$IDOutsideLoop = $post->ID;
			global $post;
			
			$auteurs = new WP_Query(array(
			'post_type' => 'Post',
			'order' => 'ASC',
			'orderby' => 'meta_value',
			'meta_key' => 'custom-title'
			));
			
			while ($auteurs->have_posts()):
		    $auteurs->the_post(); 
		?>
		<?php
		if (in_category('a-paraitre'))
			continue;
		?>
		<?php
		$title = get_post_meta($post->ID, "custom-title", true);
		if (get('auteur_atrabile')) {
		?>
		<li class="<?php
			if($IDOutsideLoop == $post->ID)
			
			{
			echo "current ";
			}
		?>auteurs_atrabile" id="postid-<?php the_ID();?>">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title();?>"><?php  echo $title;?></a><? if(($auteurs->current_post + 1) == $auteurs->post_count) echo '' ?><? if(($auteurs->current_post + 1) != $auteurs->post_count) echo ', ' ?></li>
		<?php  }else{?>
		<li class="<?php
			if($IDOutsideLoop == $post->ID)
			
			{
			echo "current ";
			}
		?>auteurs_bilenoire" id="postid-<?php the_ID();?>">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title();?>"><?php  echo $title;?></a><? if(($auteurs->current_post + 1) == $auteurs->post_count) echo '' ?><? if(($auteurs->current_post + 1) != $auteurs->post_count) echo ', ' ?></li>
		<?php  }?>

		<?php  endwhile;?>
		<? wp_reset_postdata(); ?>
	</ul>
	<?php  }?>
</aside>
