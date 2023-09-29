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

<div class="container-front-page">
    <section class="filter">
        <div class="category-filter"> 
            <p>CATÉGORIES</p>
            <select name="categorie" id="select-category" class="select-filter">
            <?php 
                $categorie_taxonomie = get_terms( array(
                    'taxonomy' => 'categorie-photo',
                    'hide_empty' => true,
                ) );
                if ( ! empty($categorie_taxonomie) && ! is_wp_error ($categorie_taxonomie) ) {
                    echo '<option value="all">Toutes les catégories</option>';
                    foreach ($categorie_taxonomie as $iteration_categorie) {
                        echo '<option class="option" value="'.$iteration_categorie->name.'"> ' .  $iteration_categorie->name  . '</option>';
                    }
                }
            ?>
            </select>
        </div>
        <div class="form-filter"> 
            <p>FORMATS</p>
            <select name="format" id="select-format" class="select-filter">
            <?php 
                $format_taxonomie = get_terms( array(
                    'taxonomy' => 'format-photo',
                    'hide_empty' => true,
                ) );
                if ( ! empty ($format_taxonomie) && ! is_wp_error($format_taxonomie) ) {
                    echo '<option value="all">Tous les formats</option>';
                    foreach ($format_taxonomie as $iteration_format) {
                        echo '<option value="'.$iteration_format->name.'"> ' . $iteration_format->name . '</option>';
                    }
                }
            ?>
            </select>
        </div>
        <div class="date-filter">
            <p>TRIER PAR</p>
            <select name="annee" id="select-date" class="select-filter">
                <option value="ASC">Les plus anciennes</option>
                <option value="DESC">Les plus récentes</option>
            </select>
        </div>
    </section>

    <section class="img-gallery">
    <?php
    $tri = isset($_POST['annee']) ? $_POST['annee'] : 'ASC';

    if ($tri === 'DESC') {
        $order = 'DESC';
    } else {
        $order = 'ASC';
    }

    $photoAccueil = array(
        'post_type' => 'photo',
        'orderby' => 'date',
        'order' => $order,
        'posts_per_page' => 12,
    );

    $query_photoAccueil = new WP_Query($photoAccueil);
    if ($query_photoAccueil->have_posts()) : while ($query_photoAccueil->have_posts()) : $query_photoAccueil->the_post(); ?>
        <div class="container-gallery">
            <?php get_template_part('/template-parts/photo-block'); ?>
        </div>
    <?php endwhile;
    endif;
    wp_reset_postdata();
    ?>
</section>

    <div class="container-more">
        <button class='button-more' type="button">Charger plus</button> 
    </div>
</div>

<?php get_footer() ?>