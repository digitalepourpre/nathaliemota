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
        <img class="hero-title" src="<?php echo get_template_directory_uri(); ?>/assets/images/photo-event.png" alt="Titre">
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
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
    );

    $catalogue_query = new WP_Query($args);
?>

<!-- filtres -->
<div class="section-filtres">
    <!-- récupère les catégories -->
    <?php function affichageCat($nomTaxonomie) {
        if ($terms = get_terms(array(
            'taxonomy' => $nomTaxonomie,
            'orderby' => 'name'
            ))) {
                foreach ($terms as $term) {
                     echo '<option class="js-filter-item" value="' . $term->slug . '">' . $term->name . '</option>';
                }
            }
        }
    ?>

    <div class="taxo_filtre">
        <!-- categories -->
        <div class="filtres-cat  js-filter">
            <form id="categories" class="js-filter-form colonne">
                <select id="categories-select">
                    <option value="all" hidden></option>
                    <option value="all">Toutes les catégories</option>
                    <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'categorie-photo',
                            'hide_empty' => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '">' . $categorie->name . '</option>';
                        }
                    ?>
                </select>
            </form>
        </div>
        <!-- formats -->
        <div class="filtre-format">
            <form id="format" class="js-filter-form  colonne">
                <select id="format-select">
                    <option value="all" hidden></option>
                    <option value="all">Tous les formats</option>
                    <?php
                        $formats = get_terms(array(
                            'taxonomy' => 'format-photo',
                            'hide_empty' => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                        }
                    ?>
                </select>
            </form>
        </div>
    </div>
    <!-- tri -->
    <div class="filtre-tri">
        <form id="ordre" class="js-filter-form colonne">
            <select id="date-select">
                <option value="all" hidden></option>
                <option value="DESC">Nouveautés</option>
                <option value="ASC">Les plus anciennes</option>
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


<div class="mota_loadmore">
    <button class="js-load-photos"
        data-posttype="photo"
        data-nonce="<?php echo wp_create_nonce('loadmore'); ?>"
        data-action="loadmore"
        data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        Charger plus
    </button>
</div>

<script>
    var bouton = document.querySelector('.js-load-photos');
    bouton.addEventListener('click', function() {
        bouton.style.display = 'none';
    });
</script>

<div class="photo-container">
    <!-- Les images chargées seront ajoutées ici -->
</div>

<?php get_footer(); ?>