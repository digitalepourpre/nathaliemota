<?php 
	get_header();
?>

<!-- Template Name: Ma page single-photo personnalisée -->

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div class="photo-container">
	
	<div class="singleInfos">
		<h2 class="singleTitle"><?php the_title(); ?></h2>
		<p>RÉFÉRENCE : <?php the_field( 'reference' ); ?></p>
		<p>CATÉGORIE : <?php the_terms( get_the_ID() , 'categorie-photo' ); ?></p>
		<p>FORMAT : <?php the_terms( get_the_ID() , 'format-photo' ); ?></p>
		<p>TYPE : <?php the_field( 'type' ); ?></p>
		<p>ANNÉE : <?php the_field('annee'); ?></p>
	</div>

	<div class="singlePhoto">
		<?php the_post_thumbnail('full'); ?>
	</div>

</div>

<div class="contact-container">

	<div class="singleContact">
		<p>Cette photo vous intéresse ?</p>
	</div>

</div>

<div class="suggestion-container">

	<div class="suggestion-title">
		<h3>VOUS AIMEREZ AUSSI</h3>
	</div>

	<div class="suggestion-photo">
		<?php
        	// Récupérer les catégories de la publication actuelle
			$current_post_categories = get_the_terms($post->ID, 'category');
			$current_category_ids = array();

			if (!empty($current_post_categories)) {
		  		foreach ($current_post_categories as $current_category) {
					if ($current_category->parent == 3) {
			  		// On ajoute seulement les ID des catégories enfant de la catégorie parent (id = 3)
			  		$current_category_ids[] = $current_category->term_id;
					}
		  		}
			}

			// Utilise wp_query pour récupérer les photos de la même catégorie
			$args = array(
				'post_type' => 'attachment', // Le type de contenu des photos.
				'posts_per_page' => 2, // Le nombre de photos à afficher.
				'tax_query' => array(
					array(
						'taxonomy' => 'categorie-photo',
						'field' => 'id',
						'terms' => $category_ids,
					),
				),
				'post__not_in' => array(get_the_ID()), // Exclure la photo courante.
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) {
				while ($query->have_posts()) { 
					$query->the_post();
					// Affiche les photos de la même catégorie ici.
		?>
		<?php get_template_part('parts/photo-block'); ?>
		<?php 	}
			} ?>
	</div>

</div>

</div>

<?php	endwhile; endif; ?>

<?php	
	get_footer(); 
?>