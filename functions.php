<?php 

    // Google web fonts pour WordPress

function google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap', false );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,400;1,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'google_fonts' );

    // Format des images de la galerie

add_action('after_setup_theme', 'wpdocs_theme_setup');
function wpdocs_theme_setup() {
    add_image_size('custom-size', 500, 500, true);
}

    // Déclarer le fichier style.css à la racine du thème

function theme_enqueue_styles() {
    wp_enqueue_style( 
        'nathaliemota',
        get_stylesheet_uri(), 
        array(), 
        '1.0'
    );

    // Charger le fichier JavaScript personnalisé

    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);
    }
    
    add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

    // Ajouter les menus à l'interface wp

register_nav_menus( array(
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
) );

    // Ajouter la prise en charge des images mises en avant

add_theme_support( 'post-thumbnails' );
// permet de définir la taille des images mises en avant 
// set_post_thumbnail_size(largeur, hauteur max, true = on adapte l'image aux dimensions)
set_post_thumbnail_size( 600, 0, false );

// Définir d'autres tailles d'images : 
// les options de base WP : 
// 'thumbnail': 150 x 150 hard cropped 
// 'medium' : 300 x 300 max height 300px
// 'medium_large' : resolution (768 x 0 infinite height)
// 'large' : 1024 x 1024 max height 1024px
//  'full' : original size uploaded
add_image_size( 'hero', 1450, 960, true );
add_image_size( 'desktop-home', 600, 520, true );
add_image_size( 'lightbox', 1300, 900, true );

    // Déclaration Custom Post Type

function nathaliemota_register_post_types() {
	$labels = array(
        'name' => 'Portfolio',
        'all_items' => 'Toutes les photos',  // affiché dans le sous menu
        'singular_name' => 'Photo',
        'add_new_item' => 'Ajouter une photo',
        'edit_item' => 'Modifier la photo',
        'menu_name' => 'Portfolio'
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-admin-customizer',
	);

	register_post_type( 'portfolio', $args );
	 
    // Déclaration de la Taxonomie format

	$labels = array(
        'name' => 'Format',
        'new_item_name' => 'Nom du nouveau Format',
    	'parent_item' => 'Type de format parent',
    );
    
    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );

    register_taxonomy( 'format-photo', 'portfolio', $args );

    // Déclaration de la Taxonomie catégorie

	$labels = array(
        'name' => 'Catégorie',
        'new_item_name' => 'Nom du nouveau Catégorie',
    	'parent_item' => 'Type de catégorie parent',
    );
    
    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );

    register_taxonomy( 'categorie-photo', 'portfolio', $args );
}

add_action( 'init', 'nathaliemota_register_post_types' );

// LOAD MORE
function mota_my_load_more_scripts() {

    global $wp_query;

	wp_enqueue_script('jquery');

	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/loadmore.js', array('jquery') );
        wp_localize_script( 'my_loadmore', 'mota_loadmore_params', array(
		    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		    'posts' => json_encode( $wp_query->query_vars ),
		    'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		    'max_page' => $wp_query->max_num_pages
	    ) 
    );
 
 	wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'mota_my_load_more_scripts' );

// AJAX

function loadmore(){
    $photosChargées = 0; // Déclarer et initialiser le compteur

    // Récupérer les articles de type "portfolio"
    $args = array(
        'post_type' => 'portfolio', // Utilisez le nom du type de publication personnalisé
        'posts_per_page' => -1, // Récupérer tous les articles
        );
    
    $query = new WP_Query($args);

    // Préparer le HTML des images
    $html = '';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Récupérer l'URL de l'image mise en avant et l'alt
            $image_url = get_the_post_thumbnail_url(get_the_ID());
            error_log('URL de l\'image : ' . $image_url);
            $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            // Ajouter l'image au HTML
            $html .= '<img src="' . $image_url . '" alt="' . $image_alt . '">';
        }
    }

    wp_reset_postdata(); // Réinitialiser la requête WP_Query

    // Comptez le nombre total d'articles de type "portfolio"
    $total_photos = wp_count_posts('portfolio')->publish;

    // Si le nombre de photos chargées est supérieur ou égal au total
    if ($photosChargées >= $total_photos) {
        wp_send_json_success('', 200); // Indique que toutes les photos sont chargées
    } else {
        $photosChargées++; // Incrémenter le compteur
  	    // Envoyer les données au navigateur
	    wp_send_json_success( $html );
    }
}
add_action('wp_ajax_loadmore', 'loadmore');
add_action('wp_ajax_nopriv_loadmore', 'loadmore');

// AJAX pour la catégorie

function filter_by_category() {
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 12,
        'orderby' => 'rand',
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categorie-photo',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $catalogue_query = new WP_Query($args);

    ob_start();

    if ($catalogue_query->have_posts()) :
        while ($catalogue_query->have_posts()) :
            $catalogue_query->the_post();
            get_template_part('/template-parts/photo-block');
        endwhile;
        wp_reset_postdata();
    endif;

    $response = ob_get_clean();
    wp_send_json_success($response);
}

add_action('wp_ajax_filter_by_category', 'filter_by_category');
add_action('wp_ajax_nopriv_filter_by_category', 'filter_by_category');

// AJAX pour le format

function filter_by_format() {
    $format = $_POST['format'];

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 12,
        'orderby' => 'rand',
    );

    if ($format !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'format-photo',
                'field' => 'slug',
                'terms' => $format,
            ),
        );
    }

    $catalogue_query = new WP_Query($args);

    ob_start();

    if ($catalogue_query->have_posts()) :
        while ($catalogue_query->have_posts()) :
            $catalogue_query->the_post();
            get_template_part('/template-parts/photo-block');
        endwhile;
        wp_reset_postdata();
    endif;

    $response = ob_get_clean();
    wp_send_json_success($response);
}

add_action('wp_ajax_filter_by_format', 'filter_by_format');
add_action('wp_ajax_nopriv_filter_by_format', 'filter_by_format');
