<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft clearfix">
			<?php query_posts($query_string . '&category_name=news&showposts=5');?>
			<?php if (have_posts()) : while (have_posts()) : the_post();?>

			<div class="post post-index news" id="post-<?php the_ID();?>">
				<span class="additional-meta">
					<?php the_time('l, j F, Y')
					?>
				</span>
				<h2 class="entry-title index-entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
				<div class="entry-content entry-content-index">
					<?php the_content(__('Read the rest of this entry &raquo;', 'blank'));?>
				</div><!-- end .entry-content -->
				<p class="entry-meta">
					<?php comments_popup_link(__('Laisser un commentaire', 'example'), __('Commentaire [1]', 'example'), __('Commentaire [%]', 'example'), 'comments-link', __('Commentaires fermés', 'example')); ?>
				</p>
			</div><!-- end .post -->
			<?php endwhile;?>
			
			<div class="navigation"><p><?php posts_nav_link(); ?></p></div>
			
			<?php else :?>
			<h2><?php _e('The page you`re looking for doesn`t exist', 'blank');?></h2>
			<div class="search-404">
				<?php _e('Do you want to search for it?', 'blank');?><br />
				<?php
					include (TEMPLATEPATH . "/searchform.php");
				?>
			</div>
			<?php endif;?>
			<?php wp_reset_query();?>
		</div><!-- end coleft -->
		<?php get_sidebar();?> <!-- end aside -->
	</div>
</div><!-- end #content -->
<?php get_footer();?>