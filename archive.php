<?php
    $post = $wp_query->post;
	
    if ( is_category('livres') || is_category('bilenoire') || is_category('collection-flegme')  || is_category('collection-bile-blanche')  || is_category('collection-fiel')  || is_category('collection-lymphe')  || is_category('collection-sang')  || is_category('hors-collection')  || is_category('collection-new') ) {
    	include(TEMPLATEPATH . '/archive/archiveLivres.php');
		}

    elseif ( is_category('auteurs') ) {
    	include(TEMPLATEPATH . '/archive/archiveAuteurs.php');
		}

    elseif ( is_category('a-paraitre') ) {
    	include(TEMPLATEPATH . '/archive/archiveParaitre.php');
		}

    else {
    	include(TEMPLATEPATH . '/archive/archiveOriginal.php');
    }
?>