<aside id="sidebar" class="smallside" role="complementary">
	<span class="additional-meta">Parcourir</span>
	<?php
	if (is_category('livres')){ // load isotope menu
	?>
	<h3>Par collection</h3>
	<ul id="filters">
				<li class="parent-item "><a class="colbut-1" href="#" data-filter="*"><span>Tous les livres</span></a></li>
			<?php
				$cat = get_query_var('cat');
//				foreach (get_categories('parent=4') as $category) {
				foreach (get_categories('parent=9') as $category) {
					//for each child of category "livres"
					echo '<li class="parent-item">
					<a class="name colbut-1" href="#" data-filter=".category-' . $category -> slug . '"><span>' . $category -> name . '</span></a>';
					echo '</li>';
				}
			?>
	</ul>
	<?php } else {?> <!-- normal select menu -->
		<div id="par-collection">
		<form action="<?php  bloginfo('url');?>/" method="get" class="jqtransform">
			<?php
			$select = wp_dropdown_categories('show_option_none=Par collection&show_count=0&orderby=name&echo=0&child_of=4');
			$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
			echo $select;
			?>
			<noscript>
				<input type="submit" value="Voir la collection" />
			</noscript>
		</form>
	</div>
		<?php } ?>
	
<!--	<div id="par-auteur">
		<form class="jqtransform" action="#">
			<select name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
				<option value="#">Par auteur</option>
				<?php dropdown_tag_cloud('number=0&order=name');?>
			</select>
		</form>
	</div>-->
</aside>