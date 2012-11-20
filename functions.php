<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)
require_once('library/custom-post-type.php'); // custom post type example

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(),  get_comment_time()) ?></a></time>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

//  ========== 
//  = Add more link in magic fields = 
//  ========== 
function multiline_with_more($multiline_name){
        global $post;
        ///Get the content  of the multiline custom field
        $multiline =  get('argumentaire');
        //if the page is_Single  we replace the <!--more--> tag for:
        //<span id="more-9-{$custom_Field_name"></span> 
        if(is_single($post->ID)){
                preg_match('/(.*)(\<\!\-\-more\-\-\>)(.*)/is',$multiline,$matches);
                return $matches[1]."<span id='more-{$post->ID}-{$multiline_name}'></span>".$matches[3];

        }else{ 
                //if not is_single the page we put a link with the message "Read the rest of this entry »"
                //and remove all the content after to <!--more--> 

                $permalink = get_permalink( $post->ID ); 

                 preg_match('/(.*)(\<\!\-\-more\-\-\>)(.*)/is',$multiline,$matches);
                 return $matches[1]." <a class='more' href='{$permalink}#more-{$post->ID}-{$multiline_name}'>[lire la suite]</a>";
        }
}
// add wp_get_archives by category
 add_filter('getarchives_where', 'customarchives_where');
 add_filter('getarchives_join', 'customarchives_join');

	function customarchives_join($x) {
		global $wpdb;
		return $x . " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
	}

	function customarchives_where($x) {
		global $wpdb;
		//$exclude = '1'; // category id to exclude
		//return $x . " AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id NOT IN ($exclude)";
		$include = '1';
		// category id to include
		return $x . " AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id IN ($include)";
	}
	
// Put tag lists in a dropdown select
        function dropdown_tag_cloud($args = '') {
            $defaults = array('smallest'=>8, 'largest'=>22, 'unit'=>'pt', 'number'=>45, 'format'=>'flat', 'orderby'=>'name', 'order'=>'ASC', 'exclude'=>'', 'include'=>'');
            $args = wp_parse_args($args, $defaults);
            
            $tags = get_tags(array_merge($args, array('orderby'=>'count', 'order'=>'DESC'))); // Always query top tags
            
            if ( empty($tags))
                return;
                
            $return = dropdown_generate_tag_cloud($tags, $args); // Here's where those top tags get sorted according to $args
            if (is_wp_error($return))
                return false;
            else
                echo apply_filters('dropdown_tag_cloud', $return, $args);
        }
        
        function dropdown_generate_tag_cloud($tags, $args = '') {
            global $wp_rewrite;
            $defaults = array('smallest'=>8, 'largest'=>22, 'unit'=>'pt', 'number'=>45, 'format'=>'flat', 'orderby'=>'name', 'order'=>'ASC');
            $args = wp_parse_args($args, $defaults);
            extract($args);
            
            if (!$tags)
                return;
            $counts = $tag_links = array();
            foreach ((array) $tags as $tag) {
                $counts[$tag->name] = $tag->count;
                $tag_links[$tag->name] = get_tag_link($tag->term_id);
                if (is_wp_error($tag_links[$tag->name]))
                    return $tag_links[$tag->name];
                $tag_ids[$tag->name] = $tag->term_id;
            }
            
            $min_count = min($counts);
            $spread = max($counts) - $min_count;
            if ($spread <= 0)
                $spread = 1;
            $font_spread = $largest - $smallest;
            if ($font_spread <= 0)
                $font_spread = 1;
            $font_step = $font_spread / $spread;
            
            // SQL cannot save you; this is a second (potentially different) sort on a subset of data.
            if ('name' == $orderby)
                uksort($counts, 'strnatcasecmp');
            else
                asort($counts);
                
            if ('DESC' == $order)
                $counts = array_reverse($counts, true);
                
            $a = array();
            
            $rel = (is_object($wp_rewrite) && $wp_rewrite->using_permalinks()) ? ' rel="tag"' : '';
            
            foreach ($counts as $tag=>$count) {
                $tag_id = $tag_ids[$tag];
                $tag_link = clean_url($tag_links[$tag]);
                $tag = str_replace(' ', '&nbsp;', wp_specialchars($tag));
                //$a[] = "\t<option value='$tag_link'>$tag ($count)</option>";
                // on affiche pas le nb de tag -> sylv1
                $a[] = "\t<option value='$tag_link'>$tag</option>";
            }
            
            switch ($format):
                case 'array':
                    $return = &$a;
                    break;
                case 'list':
                    $return = "<ul class='wp-tag-cloud'>\n\t<li>";
                    $return .= join("</li>\n\t<li>", $a);
                    $return .= "</li>\n</ul>\n";
                    break;
                default:
                    $return = join("\n", $a);
                    break;
            endswitch;
            
            return apply_filters('dropdown_generate_tag_cloud', $return, $tags, $args);
        }

// remove css in [gallery]
add_filter('gallery_style',
	create_function(
		'$css',
		'return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);'
		)
	);
	
/*  custom output for [gallery] - Xander Smalbil */
add_shortcode('livre-images', 'image_listings');

function image_listings($atts, $content = null) {
	extract(shortcode_atts(array(
	'small_image' => 'thumbnail', 
	'large_image' => 'full', 
	'captions' => '', 
	'link' => '', 
	'link_title' => '', 
	//'lightbox_group' => 'true', 
	'class' => 'galerie-livre', 
	'parent_wrap' => 'div', 
	'child_wrap' => '', 
	'id' => ''
	), $atts));

	global $post;
	$images = get_posts('post_type=attachment&post_mime_type=image&numberposts=-1&post_parent=' . $post -> ID . '&orderby=menu_order&order=ASC');
	if (empty($images)) {
		echo '';
	} else {
		$id = ($id != '') ? ' id="' . $id . '"' : '';
		$class = ($class != '') ? ' class="' . $class . '"' : '';
		$html = ($parent_wrap != '') ? "<{$parent_wrap}{$id}{$class}>\r\n" : '';
		//$lightbox = ($lightbox_group=='')?'':' rel="prettyPhoto"';
		$first = true;
		foreach ($images as $image) {
			if ($first) {
				$image_title = ($link_title == 'true') ? ' title="' . ucwords(str_replace('-', ' ', $image -> post_title)) . '"' : '';
				$alt = ($link_title == 'true') ? ' alt="' . ucwords(str_replace('-', ' ', $image -> post_title)) . '"' : '';
				$image_alt = ($alt != '') ? ' alt="' . $alt . '"' : '';
				$lrg_image = wp_get_attachment_image_src($image -> ID, $large_image);
				$thumb_image = wp_get_attachment_image_src($image -> ID, $small_image);
				$html .= ($child_wrap != '') ? "<{$child_wrap}>\r\n" : '';
				$html .= ($link == 'true') ? "\t<a href=\"{$lrg_image[0]}\"{$lightbox} id=\"img-" . $image -> ID . "\" class='cboxElement'>" : '';
				$html .= 'Voir un extrait du livre';
				$html .= '<img src="' . $thumb_image[0] . '" width="' . $thumb_image[1] . '" height="' . $thumb_image[2] . '"' . $alt . ' class="attachment-thumbnail colorbox-01" />';
				$html .= ($link == 'true') ? "</a>\r\n" : "\n\t";
				$html .= ($captions == 'true') ? "\t<span>" . ucwords(str_replace('-', ' ', $image -> post_title)) . "</span>\r\n" : '';
				$html .= ($child_wrap != '') ? "</{$child_wrap}>\r\n" : '';
				$lrg_image = '';
				$first = false;
			} else {
				$image_title = ($link_title == 'true') ? ' title="' . ucwords(str_replace('-', ' ', $image -> post_title)) . '"' : '';
				$alt = ($link_title == 'true') ? ' alt="' . ucwords(str_replace('-', ' ', $image -> post_title)) . '"' : '';
				$image_alt = ($alt != '') ? ' alt="' . $alt . '"' : '';
				$lrg_image = wp_get_attachment_image_src($image -> ID, $large_image);
				$thumb_image = wp_get_attachment_image_src($image -> ID, $small_image);
				$html .= ($child_wrap != '') ? "<{$child_wrap}>\r\n" : '';
				$html .= ($link == 'true') ? "\t<a href=\"{$lrg_image[0]}\"{$lightbox} id=\"img-" . $image -> ID . "\" class='cboxElement'>" : '';
				$html .= '<img src="' . $thumb_image[0] . '" width="' . $thumb_image[1] . '" height="' . $thumb_image[2] . '"' . $alt . ' class="attachment-thumbnail colorbox-01" />';
				$html .= ($link == 'true') ? "</a>\r\n" : "\n\t";
				$html .= ($captions == 'true') ? "\t<span>" . ucwords(str_replace('-', ' ', $image -> post_title)) . "</span>\r\n" : '';
				$html .= ($child_wrap != '') ? "</{$child_wrap}>\r\n" : '';
				$lrg_image = '';
			}

		}
		$html .= ($parent_wrap != '') ? "</{$parent_wrap}>" : '';
		return $html;
	}
}
?>