<?php get_header(); ?>
			
			<div id="content" class="wrap">
			
				<div id="inner-content" class="clearfix">
					
						<div id="home_left">
						<!-- start NEWS LOOP-->
						 <?php query_posts('category_name=news&showposts=2'); ?>
						 <?php if (have_posts()) : ?>
						  <?php while (have_posts()) : the_post(); ?>
							 <div class="home-news" id="post-<?php the_ID(); ?>">
									<div class="entry-content entry-content-index">
									<span class="additional-meta">Le <?php the_time('j F Y') ?></span>
									<h2 class="entry-title index-entry-title"><a href="category/news" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<div class="content">
									<?php the_content( __('[lire la suite]', 'blank')); ?>
									</div>
								</div><!-- end .entry-content-->
							</div>
						  <?php endwhile; ?>
						<!-- end NEWS LOOP-->
						</div><!-- end #col_left -->
						<div id="home_right">
						<!-- start A PARAITRE LOOP-->
						<span class="additional-meta">Prochaine parution</span>
						<?php $a_paraitre = new WP_Query('category_name=a-paraitre&showposts=1&order=ASC');
							  while ($a_paraitre->have_posts()) : $a_paraitre->the_post();
						?>
							<div class="home-aparaitre clearfix" id="post-<?php the_ID(); ?>">        				
								<div class="entry-content entry-content-index">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="image_catalogue" src="<?php echo get('image_catalogue');?>" alt="" /></a>
									<h2 class="entry-title index-entry-title"><?php the_title(); ?></h2>
									<div class="home-auteur">
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
						        <?php $title = get_post_meta($post->ID, "custom-title", true); ?>
						        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php $title; ?>"><?php echo $title; ?></a>
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
									</div>
									<div class="content">
									<?php //get article (custom field) ?>
							        <?php $pres = get_post_meta($post->ID, 'presentation', true); ?>
							        <?php if (! empty($pres)) { ; ?>
							        <?php echo get('presentation'); ?>
									</div>
							        <?php } ; ?>
									<?php echo multiline_with_more('argumentaire'); ?>
									</div>
								</div><!-- end .entry-content-->
							</div>
						  <?php endwhile; ?>
						<!-- end A PARAITRE LOOP-->
						<!-- start DERNIER LIVRE LOOP - exclude category "à paraitre" -->
						<span class="additional-meta">Dernière parution</span>
						<?php $last_book = new WP_Query('cat=4,-3&showposts=1');
							  while ($last_book ->have_posts()) : $last_book->the_post();
						?>
						
							 <div class="home-livre clearfix" id="post-<?php the_ID(); ?>">
									        				
								<div class="entry-content entry-content-index">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="image_catalogue" src="<?php echo get('image_catalogue');?>" alt="" /></a>
									<h2 class="entry-title index-entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<div class="home-auteur">
									<?php 
						        $backup = $post; // backup the current object
						        $tags = wp_get_post_tags($post->ID);
						        $tagIDs = array();
						        if ($tags) {
						            echo '<h3>par';
						             $first_tag = $tags[0]->term_id;
						            $args = array('cat'=>5, 'tag__in' => array($first_tag),
						                //'category_in' => array(4),
						                'showposts'=>5, 'caller_get_posts'=>1);
						            $my_query = new WP_Query($args);
						            if ($my_query->have_posts()) {
						                while ($my_query->have_posts()):
						                    $my_query->the_post();
						                    
						        ?>
						        <?php $title = get_post_meta($post->ID, "custom-title", true); ?>
						        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php $title; ?>"><?php echo $title; ?></a>
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
								</div>
									<div class="content">
									<?php //get article (custom field) ?>
							        <?php $pres = get_post_meta($post->ID, 'presentation', true); ?>
							        <?php if (! empty($pres)) { ; ?>
							        <?php echo get('presentation'); ?>
							        <?php } ; ?>
									<?php echo multiline_with_more('argumentaire'); ?>
									</div>
								</div><!-- end .entry-content-->
							</div>
						<?php endwhile; ?>
						</div><!-- end #col_right -->
						<?php else: ?>
						
						<!-- end DERNIER LIVRE LOOP-->
									<p>Désolé, pas d'articles.</p>
						<?php endif; ?>
					
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>