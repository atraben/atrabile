<?php
    $post = $wp_query->post;
    if ( in_category('auteurs') ) {
    	include(TEMPLATEPATH . '/single/singleAuteurs.php');
		}

    elseif ( in_category('livres') || in_category('bilenoire') || in_category('collection-flegme')  || in_category('collection-bile-blanche')  || in_category('collection-fiel')  || in_category('collection-lymphe')  || in_category('collection-sang')  || in_category('hors-collection')  || in_category('collection-new') ) {
    	include(TEMPLATEPATH . '/single/singleLivres.php');
		}
	
	elseif ( in_category('news') ) {
    	include(TEMPLATEPATH . '/single/singleNews.php');
		}
	
    else {
    	include(TEMPLATEPATH . '/single/singleOriginal.php');
    }
?>