<?php get_header(); ?>

<?php 
    // Champs ACF
    $titre = get_field('nom'); 
    $type = get_field('type');
    $annee = get_field('annee');
	$photo_url = get_field('photo');
    $reference = get_field('reference'); 

    // Champs de Taxonomies
    $taxo_categorie = get_the_terms(get_the_ID(), 'categorie-photo'); 
    $taxo_format = get_the_terms(get_the_ID(), 'format-photo'); 
	
    //Récupération de l'id et de l'url	
	$id = get_the_ID();
    $url = get_permalink();

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'format-photo',
                'field' => 'slug',
                'terms' => 'paysage',
            ),
        ),
        'orderby' => 'rand', // Sélectionner une image aléatoire
    );

    $random_query = new WP_Query($args);

?>

<!-- HERO -->
<div class="hero">
        
    <?php
        if ($random_query->have_posts()) :
        while ($random_query->have_posts()) :
        $random_query->the_post();
        // Récupérer l'image en tant que fond du héros
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>

    <div class="hero-banner" style="background-image: url('<?php echo esc_url($image_url); ?>');">
        <div class="hero-title">
            <img class="photograph-event" src="<?php echo get_template_directory_uri() .'/assets/images/photo-event.png';?>" alt="Titre du hero">
        </div>
    </div>

    <?php endwhile;
        wp_reset_postdata();
        endif;
    ?>
</div>

<?php get_footer(); ?>