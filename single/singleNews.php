<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft clearfix">
			<!-- start NEWS LOOP-->
			<?php if (have_posts()) : while (have_posts()) : the_post();
			?>
			<div class="home-news" id="post-<?php the_ID();?>">
				<span class="additional-meta">Le <?php the_time('j F Y')?></span>
				<h2 class="entry-title index-entry-title"><?php the_title();?></h2>
				<div class="entry-content entry-content-index">
					<?php the_content(__('[lire la suite]', 'blank'));?>
				</div><!-- end .entry-content-->
			</div>
			<?php comments_template('', true);?>
			<?php endwhile;?>
			<!-- end NEWS LOOP-->
			<div class="navigation" id="nav-single">
				<div class="nav-prev nav-prev-single">
					<?php previous_post_link('%link', '%title', TRUE);?>
				</div>
				<div class="nav-next" id="nav-next-single">
					<?php next_post_link('%link', '%title', TRUE);?>
				</div>
			</div>
			<?php else :?>
			<?php _e('Sorry, no posts matched your criteria', 'blank');?>.
			<?php endif;?>
		</div><!-- end coleft -->
		<?php get_sidebar();?> <!-- end aside -->
	</div>
</div><!-- end #content -->
<?php get_footer();?>
