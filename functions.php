<?php 

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
