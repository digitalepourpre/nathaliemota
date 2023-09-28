<?php get_header(); ?>


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
		<?php the_post_thumbnail('medium'); ?>
	</div>

</div>

<div class="contact-container">

	<div class="demande-contact">

		<div class="singleContact">
			<p>Cette photo vous intéresse ?</p>
		</div>

		<button id="bouton-contact">Contact</button>
	</div>

	<div class="photo-navigation">
		<div class="fleche-navigation">
			<img class="fleche gauche" src="<?php echo get_template_directory_uri(); ?>/assets/images/left-arrow.svg" alt="fleche gauche">
			<img class="fleche droite" src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow.svg" alt="fleche droite">
		</div>
	</div>
        
</div>

<div class="suggestion-container">
	<div class="suggestion">
		<div class="suggestion-title">
			<h3>VOUS AIMEREZ AUSSI</h3>
		</div>
	</div>

	<div class="suggestion-photo">
		<?php
			// Affiche ici les photos apparentées en utilisant WP_Query
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => 2,
				'cat' => $category_id,
				'post__not_in' => array(get_the_ID()), // Exclure le contenu actuel
			);
		
			$query = new WP_Query($args);
		
			if ($query->have_posts()) :
			while ($query->have_posts()) :
			$query->the_post();
			get_template_part('templates_parts/photo-block');
			endwhile;
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>

<?php
endwhile; endif;
get_footer();
?>