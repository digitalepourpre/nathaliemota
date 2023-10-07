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
        // Récupérer l'image en tant que fond du hero
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>

    <div class="hero-banner"> 
        <img class="hero-img" src="<?php echo esc_url($image_url); ?>" alt="Image du hero">
        <h1>PHOTOGRAPHE EVENT</H1>
    </div>

    <?php endwhile;
        wp_reset_postdata();
        endif;
    ?>
</div>

<!-- CATALOGUE -->
<?php
    $args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 12,
    'orderby' => 'rand', // Sélectionner une image aléatoire
    );

    $catalogue_query = new WP_Query($args);
?>

<div class="catalogue-photo">

    <?php
        if ($catalogue_query->have_posts()) : 
        while ($catalogue_query->have_posts()) :
        $catalogue_query->the_post();
    ?>

    <div class ="grille-photo">
        <?php get_template_part('/template-parts/photo-block'); ?>
    </div>
    
    <?php endwhile;
        wp_reset_postdata();
        endif;
    ?>

</div>

<div class="load-more-container">
    <button id="load-more">Charger plus</button>
</div>

<?php get_footer(); ?>