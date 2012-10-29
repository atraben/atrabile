<?php  get_header();?>
<div id="content" class="wrap">
	<div id="inner-content" class="clearfix">
		<div class="clearfix">
			<?php
			if (have_posts()):
			?> <?php
			$post = $posts[0];
			// Hack. Set $post so that the_date() works.
			?>
			<h2 class="archive-title"><?php  single_cat_title();?></h2>
			<div class="auteurs_content">
				<ul class="auteurs-archive">
					<!--<?php $posts = query_posts($query_string . '&orderby=meta_value&meta_key=custom-title&order=asc'); ?>-->
					
					<?php $posts = query_posts( array(
					  'post_type' => 'Post',
					  'order' => 'ASC',
					  'orderby' => 'custom-title',
					  'meta_key' => 'custom-title' // filtre - qui contient le custom-field ''custom-title''
					) );
					while (have_posts()):
					the_post();
					?>
					<?php
					if (in_category('a-paraitre'))
						continue;
					?>
					<?php
					$title = get_post_meta($post->ID, "custom-title", true);
					if (get('auteur_atrabile')) {
					?>
					<li class="auteurs_atrabile" id="post-<?php the_ID();?>">
						<a
						href="<?php the_permalink() ?>" rel="bookmark"
						title="<?php the_title();?>"><?php  echo $title;?>, </a>
					</li>
					<?php  }else{?>
					<li class="auteurs_bilenoire" id="post-<?php the_ID();?>">
						<a
						href="<?php the_permalink() ?>" rel="bookmark"
						title="<?php the_title();?>"><?php  echo $title;?>, </a>
					</li>
					<?php  }?>

					<?php  endwhile;?>
				</ul>
			</div>
			<!-- end .post -->
			<?php  else:?>
			<h2><?php
			_e('The page you`re looking for doesn`t exist', 'blank');
			?></h2>
			<div class="search-404">
				<?php
				_e('Do you want to search for it?', 'blank');
				?>
				<br />
				<?php
				include (TEMPLATEPATH . "/searchform.php");
				?>
			</div>
			<?php
			endif;
			?>
		</div>
	</div>
</div><!-- end #content -->
<?php get_footer();?>
