<?php
/*
 Template Name: Archives Livre par Auteur
 */
?>

<?php get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="coleft clearfix">
			<?php wp_get_post_tags($post -> ID);?>
			<h2>Tous les livres de Baladi</h2>
			<?php $my_query = new WP_Query('category_name=Livres&tag=Baladi');
			if (have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
			?>

			<div id="post-<?php the_ID();?> livre-thumb">
				<a href="<?php the_permalink() ?>" title="<?php the_title();?> | <?php	$category = get_the_category();
				echo $category[0] -> cat_name;
				?>"> <img src="<?php echo get('image_catalogue');?>" alt="" class="image_catalogue" /> </a>
			</div>
			
			<?php endwhile;?>
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
		<?php get_sidebar();?> <!-- end aside -->
	</div>
</div><!-- end #content -->
<?php get_footer();?>
