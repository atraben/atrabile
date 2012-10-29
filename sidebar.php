<?php

	//sidebar auteurs is "sidebar-auteur.php"

	if ( is_tag() || is_category( array( 'livres' , 'revue-bile-noire' , 'collection-flegme' , 'collection-bile-blanche' , 
	'collection-fiel' , 'collection-lymphe' , 'collection-sang' , 'hors-collection' , 'collection-new'  ) )) {
	include(TEMPLATEPATH . '/sidebar/sidebarCatalogue.php');
	}
	
	elseif ( in_category( array( 'livres' , 'revue-bile-noire' , 'collection-flegme' , 'collection-bile-blanche' , 
	'collection-fiel' , 'collection-lymphe' , 'collection-sang' , 'hors-collection' , 'collection-new'  ) )) {		
		include(TEMPLATEPATH . '/sidebar/sidebarLivres.php');
	}
	    
	else {
		include(TEMPLATEPATH . '/sidebar/sidebarOriginal.php');
	}
?>