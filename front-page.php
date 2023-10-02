<?php get_header() ?>

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

//Flèches précédent et suivant
	$nextPost = get_next_post();
    $previousPost = get_previous_post();
?>

    <?php            
        $random_photo = array(
            'post-type' => 'portfolio',
            'orderby' => 'rand',
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'format-photo',
                    'field' => 'slug',
                    'terms' =>'paysage',
                ),
            ),
        );
            $wp_query_ramdom_photo = new WP_query($random_photo);
            if( $wp_query_ramdom_photo -> have_posts() ) : while( $wp_query_ramdom_photo -> have_posts() ) : $wp_query_ramdom_photo -> the_post(); ?>

                <div class="front-page-hero">
                     <img src="<?php echo get_field('photo'); ?>" alt="<?php the_title_attribute(); ?>">
                    <h1>PHOTOGRAPHE EVENT</h1>
                </div> 
            
        <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>

<?php get_footer() ?>