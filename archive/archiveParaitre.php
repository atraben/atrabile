<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<?php if (have_posts()) :
		?>
		<?php $post = $posts[0];
			// Hack. Set $post so that the_date() works.
		?>
		<?php while (have_posts()) : the_post(); if( $post->ID == '12' ) continue;
		?>
		<div id="paraitre">
			<div class="coleft post post-<?php the_ID();?> clearfix">
				<?php the_title('<h2 class="entry-title">', '. </h2>');?>
				<?php 
				        //for use in the loop, list 50 post titles related to tag and categories on current post
				        $backup = $post; // backup the current object
				        $tags = wp_get_post_tags($post->ID);
				        $tagIDs = array();
				        if ($tags) {
				            echo '<h3>par';
				            $tagcount = count($tags);
				            for ($i = 0; $i < $tagcount; $i++) {
				                $tagIDs[$i] = $tags[$i]->term_id;
				            }
				            
				            $args = array('cat'=>5, 'tag__in'=>$tagIDs,
				                /*    'post__not_in' => array($post->ID), */
				                'showposts'=>50, 'caller_get_posts'=>1);
				            $my_query = new WP_Query($args);
				            if ($my_query->have_posts()) {
				                while ($my_query->have_posts()):
				                    $my_query->the_post();
				                    
			
			
			
				?>
				<?php $title = get_post_meta($post -> ID, "custom-title", true);?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php $title;?>"><?php echo $title;?></a>
				<?php
				endwhile;
				} else {
				?>
				Manque l'auteur!
				<?php
				}
				echo '</h3>';
				}
				$post = $backup; // copy it back
				//wp_reset_query(); // to use the original query again
				?>
			
				<div class="content-indent">
					<?php $newImg = "h=380&w=270&zc=1&q=100";?>
					<?php echo get_image('images_livre', 1, 1, 1, NULL, $newImg);?>
					<div class="livre-content">
						<div class="livre-infos">
							<?php
						// Get the ID of the "first = [0]" given category - Tous les livres de la collection
						$cat = get_the_category();
						$cat = $cat[1];
						// Get the URL of this category
						$category_livre = get_category_link($cat);
						?>
						<strong class="cat-desc"><?php $categoryname = get_the_category();
								echo $categoryname[1] -> cat_name;
							?> </strong> | <?php echo get('technique');?>
							<div class="collapsed">
								<a href="<?php echo $category_livre;?>" rel="bookmark"><?php $categorydesc = get_the_category();
								echo $categorydesc[1] -> category_description;
								?> </a>
							</div>
							<div class="livre-tech">
								<?php echo get('format');?><br />
								<?php echo get('prix');?><br />
								<?php echo get('isbn');?><br />
								<?php echo get('ean');?></div>
						</div>
						<?php echo get('argumentaire');?>
					</div>
				</div>
			</div>
			<div class="colright">
				<div class="parution">
					Parution prévue en <br /><?php the_time('F Y')
					?>
				</div>
				<?php
				global $post;
				foreach (get_the_tags($post->ID) as $tag) {
			
					echo '<a href="' . get_option('home') . '/tag/' . $tag -> slug . '/" rel="tag">';
					echo 'Tous les livres de ' . $tag -> name . '<br />';
					echo '</a>';
			
				}
				?>
				<?php
				// Get the ID of the "first = [0]" given category - Tous les livres de la collection
				$cat = get_the_category();
				$cat = $cat[1];
				// Get the URL of this category
				$category_niv1 = get_category_link($cat);
				?>
				<a href="<?php echo $category_niv1;?>" rel="bookmark" title="<?php	$categoryname = get_the_category(); echo $categoryname[1] -> cat_name;?>">
				Tous les livres de la collection
				</a>
			</div>
		</div>
		<!-- end .post -->
		<?php endwhile;?>
		<?php else :?> <h2><?php _e('The page you`re looking for doesn`t exist', 'blank');?></h2>
		<div class="search-404">
			<?php _e('Do you want to search for it?', 'blank');?>
			<br />
			<?php
			include (TEMPLATEPATH . "/searchform.php");
			?>
		</div>
		<?php endif;?>
	</div>
</div><!-- end #content -->
<?php get_footer();?>
