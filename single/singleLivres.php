<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<?php if (have_posts()) :
		?>
		<?php while (have_posts()) : the_post();
		?>
		<div id="single-livre">
				<?php the_title('<h2 class="entry-title">', '</h2>');?>
				<?php 
				        //for use in the loop, list 50 post titles related to tag and categories on current post
				        $backup = $post; // backup the current object
				        $tags = wp_get_post_tags($post->ID);
				        $tagIDs = array();
				        if ($tags) {
				            echo '<h3>Par';
				            $tagcount = count($tags);
				            for ($i = 0; $i < $tagcount; $i++) {
				                $tagIDs[$i] = $tags[$i]->term_id;
				            }
				            
				            $args = array('category_name'=>'auteurs', 'tag__in'=>$tagIDs,
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
			<div class="coleft post post-<?php the_ID();?> clearfix">

				<div class="content-indent clearfix">
					<div class="livre-image">
					<?php $newImg = "h=380&w=270&zc=1&q=100";?>
					<?php echo get_image('images_livre', 1, 1, 1, NULL, $newImg);?>
<!--					<img src="<?php the_field('images_livre'); ?>" class="livre-image" />-->
					<?php echo do_shortcode("[livre-images link='true']");?>
					</div>
					<div class="livre-content">
						<div class="livre-infos">
							<?php
							if (in_category('a-paraitre')){
							?>
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
							<?php  }else{?>
							<?php
							// Get the ID of the "first = [0]" given category - Tous les livres de la collection
							$cat = get_the_category();
							$cat = $cat[0];
							// Get the URL of this category
							$category_livre = get_category_link($cat);
							?>
							<strong class="cat-desc"><?php $categoryname = get_the_category();
								echo $categoryname[0] -> cat_name;
							?> </strong>
							<div class="collapsed">
								<a href="<?php echo $category_livre;?>" rel="bookmark"><?php $categorydesc = get_the_category();
								echo $categorydesc[0] -> category_description;
								?> </a>
							</div>
							<?php } ?>	
							<div class="livre-tech">
							    <?php echo get('technique');?><br />
								<?php echo get('format');?><br />
								<?php echo get('reliure');?><br />
								<?php echo get('prix');?><br />
								isbn <?php echo get('isbn');?><br />
								Paru en <?php the_date('F Y'); ?><br /></div>
						</div>
						<?php echo get('argumentaire');?>
					</div>
				</div>
			</div>
			<div class="colright">
			
			<?php
			// Get the ID of the "first = [0]" given category - Tous les livres de la collection
			$cat = get_the_category();
			$cat = $cat[0];
			// Get the URL of this category
			$category_niv1 = get_category_link($cat);
			?> <a class="colbut-1" href="<?php echo $category_niv1;?>" rel="bookmark" title="<?php	$categoryname = get_the_category();
				echo $categoryname[0] -> cat_name;
			?>"><span>Dans la même collection</span></a>
			
			
				<?php
				global $post;
				foreach (get_the_tags($post->ID) as $tag) {

					echo '<a class="colbut-2" href="' . get_option('home') . '/tag/' . $tag -> slug . '/" rel="tag">';
					echo '<span>Les livres de<br />' . $tag -> name . '</span><br />';
					echo '</a>';

				}
				?>
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
