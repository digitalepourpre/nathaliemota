<?php get_header(); ?>

<?php 
    // Champs ACF
    $titre = get_field('nom'); 
    $type = get_field('type');
    $annee = get_field('annee');
	$image_id = get_field('photo');
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

<div class="section-filtres">

    <div class="categorie-filtre">
        <form class="colonne-filtre">
            <select id="categories">
                <option value="all" hidden></option>
                <option value="all" selected>CATÉGORIES</option>
                <?php
                    $categories = get_terms(array(
                        "taxonomy" => "categorie-photo",
                        "hide_empty" => false,
                    ));
                    foreach ($categories as $categorie) {
                        echo '<option value="' . $categorie->slug . '">' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                    }
                ?>
            </select>
        </form>
    </div>

    <div class="format-filtre">
        <form class="colonne-filtre">
            <select id="formats">
                <option value="all" hidden></option>
                <option value="all" selected>FORMATS</option>
                <?php
                    $formats = get_terms(array(
                        "taxonomy" => "format-photo",
                        "hide_empty" => false,
                    ));
                    foreach ($formats as $format) {
                        echo '<option value="' . $format->slug . '">' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                    }
                ?>
            </select>
        </form>
    </div>

    <div class="date-filtre">
        <form class="colonne-filtre">
            <select id="dates">
                <option value="all" hidden></option>
                <option value="all" selected>TRIER PAR</option>
                <option value="DESC">Les Plus Récentes</option>
                <option value="ASC">Les Plus Anciennes</option>
            </select>
        </form>
    </div>
</div>

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


<div>
    <button class="js-load-photos"
        data-posttype="photo"
        data-nonce="<?php echo wp_create_nonce('loadmore'); ?>"
        data-action="loadmore"
        data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        Charger plus de photos</button>
</div>

<?php get_footer(); ?>