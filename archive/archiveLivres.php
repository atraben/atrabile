<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft-big">
			<?php
			if (have_posts()):
			?>
			<h2 class="archive-title"><?php single_cat_title();?></h2>
			<div class="post post-index livres-thumb" id="catalogue-content">
				
				<?php
				while (have_posts()):
				the_post();
				?>
				<?php
				if (in_category('a-paraitre'))
					continue;
				?>
				<a <?php post_class('image_catalogue'); ?> href="<?php the_permalink() ?>">
					<img src="<?php echo get('image_catalogue');?>" alt="" />
				</a>
				<!-- <div class="tooltip">
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
				</div> -->
				<!-- end .post -->
				<?php
				endwhile;
				?>
			</div><!-- end .post -->
			<?php
			else :
			?>
			<h2><?php
			_e('The page you`re looking for doesn`t exist', 'blank');
			?></h2>
			<div class="search-404">
				<?php
				_e('Do you want to search for it?', 'blank');
				?>
				<br/>
				<?php
				include (TEMPLATEPATH . "/searchform.php");
				?>
			</div>
			<?php
			endif;
			?>
		</div><!-- end coleft -->
		<?php get_sidebar();?><!-- end aside -->
	</div>
</div><!-- end #content -->
<?php get_footer();?>
