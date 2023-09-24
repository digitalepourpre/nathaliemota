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

<?php	endwhile; endif; ?>

<?php	
	get_footer(); 
?>