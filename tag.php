<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft-big">
			<h2 class="archive-title"><?php /* If this is a category */ if (is_category()) {
			?>
			<?php _e('Category', 'blank');?>&#8220;<?php single_cat_title();?>&#8221; <?php /* If this is a tag */ } elseif( is_tag() ) {?>
			<?php _e('Tous les livres de', 'blank');?>&#8220;<?php single_tag_title();?>&#8221; <?php /* If this is a daily archive */ } elseif (is_day()) {?>
			<?php _e('Archive for', 'blank');?> <?php the_time('F jS, Y');?>

			<?php /* If this is a monthly archive */ } elseif (is_month()) {?>
			<?php _e('Archive for', 'blank');?> <?php the_time('F, Y');?>

			<?php /* If this is a yearly archive */ } elseif (is_year()) {?>
			<?php _e('Archive for', 'blank');?> <?php the_time('Y');?>

			<?php /* If this is an author archive */ } elseif (is_author()) {?>
			<?php _e('Author Archive ', 'blank');?>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {?>
			<?php _e('Blog archives ', 'blank');?>
			<?php }?></h2>
			
			<div class="post post-index livres-thumb" id="tag-content">
				<?php if (have_posts()) : while (have_posts()) : the_post();
				?>
				<?php
				if (in_category('a-paraitre'))
					continue;
				?>
				<?php
				if (in_category('auteurs'))
					continue;
				?>
				<?php
				if (in_category('news'))
					continue;
				?>
				<a class="image_catalogue" href="<?php the_permalink() ?>">
					<img src="<?php echo get('image_catalogue');?>" alt="" />
				</a>
				<div class="tooltip">
					<h3><?php the_title();?></h3>
					<?php
					//for use in the loop, list 50 post titles related to tag and categories on current post
					$backup = $post; // backup the current object
					$tags = wp_get_post_tags($post->ID);
					$tagIDs = array();
					echo '<span class="auteurs-tip">Par';
					$tagcount = count($tags);
					for ($i = 0; $i < $tagcount; $i++) {
					$tagIDs[$i] = $tags[$i]->term_id;
					}
					$args = array('cat'=>5, 'tag__in'=>$tagIDs,'showposts'=>50, 'caller_get_posts'=>1);
					$my_query = new WP_Query($args);
					while ($my_query->have_posts()): $my_query->the_post();
					?>
					<?php $title = get_post_meta($post -> ID, "custom-title", true);?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $title;?></a>
					<?php
					endwhile;
					?>
					</span>
				</div>
				<!-- end .post -->
				<?php
				endwhile;
				?>
			</div><!-- end .post -->
			<?php
			else :
			?>
			<h2><?php _e('The page you`re looking for doesn`t exist', 'blank');?></h2>
			<div class="search-404">
				<?php _e('Do you want to search for it?', 'blank');?><br />
				<?php
				include (TEMPLATEPATH . "/searchform.php");
				?>
			</div>
			<?php endif;?>
		</div><!-- end coleft -->
		<?php get_sidebar();?><!-- end aside -->
	</div>
</div><!-- end #content -->
<?php get_footer();?>
