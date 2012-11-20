<?php get_header();?>
<div id="content" class="single-auteur wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft clearfix">
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
					<div class="post" id="post-single">
						<?php
						$title = get_post_meta($post->ID, "custom-title", true);
						if ($title != "") {
						echo "<h2 class='archive-title' id='archive-title-single'>".$title."</h2>";
						} else {

						?>
						<h2><?php the_title();?></h2>
						<?php }?> <!--<h2 class="entry-title" id="entry-title-single"><?php $posttags = get_the_tags(); $count=0; if ($posttags) { foreach($posttags as $tag) { $count++; if (1 == $count) { echo $tag->name . ' '; } } } ?></h2> -->
						<?php remove_filter('the_content', 'wpautop');?>
						<div class="auteurs_content">
							<?php echo get('bio');?>
						</div>
					</div>
					<!-- end .post -->
					<?php endwhile; else :?>
					<?php _e('Sorry, no posts matched your criteria', 'blank');?>.
					<?php endif;?>

					<?php
					//for use in the loop, list 3 post titles related to tag on current post
					$backup = $post; // backup the current object
					$tags = wp_get_post_tags($post->ID);
					$tagIDs = array();
					if ($tags) {
					$tagcount = count($tags);
					for ($i = 0; $i < $tagcount; $i++) {
					$tagIDs[$i] = $tags[$i]->term_id;
					}
					$args = array('cat'=>1, 'tag__in'=>$tagIDs, 'post__not_in'=>array($post->ID), 'showposts'=>3, 'caller_get_posts'=>1);
					$my_query = new WP_Query($args);
					if ($my_query->have_posts()) {

					?>
					<?php while ($my_query->have_posts()): $my_query->the_post();
					?>
					<?php if (get_the_time('U') + 2629743 > gmdate('U')) {
					?>
					<div class='autre_news'>
						<h4>&laquo; <a href="<?php the_permalink() ?>" title="<?php the_title();?>"><?php the_title();?></a></h4>
						<?php the_excerpt();?>
						&raquo;
					</div>
					<?php }?>
					<?php endwhile;?>
					<?php } else {?>
					<?php
					}
					}
					$post = $backup; // copy it back
					wp_reset_query(); // to use the original query again
					?>
					<div class="enplus"  id="bibliographie">
						
						<!-- bibliographie sans bile-noire-->
						<div class="biblio biblio-livre">
						<?php
							//for use in the loop, list 50 post titles related to tag on current post
							$backup = $post; // backup the current object
							$tags = wp_get_post_tags($post->ID);
							$tagIDs = array();
							if ($tags) {
							echo '<strong class="bio-title">Bibliographie atrabilaire:</strong>';
							echo '<ul>';
							$tagcount = count($tags);
							for ($i = 0; $i < $tagcount; $i++) {
							$tagIDs[$i] = $tags[$i]->term_id;
							}
							$args = array('category_name'=> 'livres', 'category__not_in' => 11, 'tag__in'=>$tagIDs, 'post__not_in'=>array($post->ID), 'showposts'=>50, 'caller_get_posts'=>1);
							$my_query = new WP_Query($args);
							if ($my_query->have_posts()) {
							while ($my_query->have_posts()):
							$my_query->the_post();

							?>
							<?php
							if (get_the_time('U') > gmdate('U')) {

							?>
							<li>
								<a href="<?php echo get_category_link(3);?>" rel="bookmark"
								title="<?php the_title();?>"><?php the_title();?></a> | <?php $category = get_the_category();
									echo $category[1] -> cat_name;
								?>
								| <span class="temps">&Agrave; para&icirc;tre</span>
							</li><?php } else {?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark"
								title="<?php the_title();?>"><?php the_title();?></a> | <?php $category = get_the_category();
									echo $category[0] -> cat_name;
								?>
								| <span class="temps"><?php the_time('F Y');?></span>
							</li>
							<?php
							}
							;
							?>
							<?php endwhile;?>
							</ul>
							<?php } else {?>
							<h3>Pas de livre chez ATRABILE !</h3>
							<?php
							}
							}
							$post = $backup; // copy it back
							wp_reset_query(); // to use the original query again
						?>
						</div>
						
						<!-- biblio bile-noire	-->
						<div class="biblio biblio-bile">
						<?php
							//for use in the loop, list 50 post titles related to tag on current post
							$backup = $post; // backup the current object
							$tags = wp_get_post_tags($post->ID);
							$tagIDs = array();
							if ($tags) {
							echo '<strong class="bio-title">Revue Bile Noire:</strong>';
							echo '<ul>';
							$tagcount = count($tags);
							for ($i = 0; $i < $tagcount; $i++) {
							$tagIDs[$i] = $tags[$i]->term_id;
							}
							$args = array('category_name'=> 'revue-bile-noire', 'tag__in'=>$tagIDs, 'post__not_in'=>array($post->ID), 'showposts'=>50, 'caller_get_posts'=>1);
							$my_query = new WP_Query($args);
							if ($my_query->have_posts()) {
							while ($my_query->have_posts()):
							$my_query->the_post();

							?>
							<?php
							if (get_the_time('U') > gmdate('U')) {

							?>
							<li>
								<a href="<?php echo get_category_link(3);?>" rel="bookmark"
								title="<?php the_title();?>"><?php the_title();?></a> | <?php $category = get_the_category();
									echo $category[1] -> cat_name;
								?>
								| <span class="temps">&Agrave; para&icirc;tre</span>
							</li><?php } else {?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark"
								title="<?php the_title();?>"><?php the_title();?></a> | <?php $category = get_the_category();
									echo $category[0] -> cat_name;
								?>
								| <span class="temps"><?php the_time('F Y');?></span>
							</li>
							<?php
							}
							;
							?>
							<?php endwhile;?>
							</ul>
							<?php } else {?>
							<h3>Pas de livre chez ATRABILE !</h3>
							<?php
							}
							}
							$post = $backup; // copy it back
							wp_reset_query(); // to use the original query again
						?>
						</div>
					</div><!-- end #bibliographie -->
					<?php $liens = get_post_meta($post -> ID, 'liens', true);?>
						<?php if (! empty($liens)) { ;
						?>
						<div class="bio-link"><?php echo get('liens');?></div>
					<?php } ;?>
				</div><!-- end coleft -->
				<?php get_sidebar('auteur');?> <!-- end aside -->
			</div>
		</div><!-- end #content -->
		<?php get_footer();?>
