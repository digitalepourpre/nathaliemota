<?php 

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// Ajouter les menus à l'interface wp
register_nav_menus( array(
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
) );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Déclarer le fichier style.css à la racine du thème
wp_enqueue_style( 
	'nathaliemota',
	get_stylesheet_uri(), 
	array(), 
	'1.0'
);

// Charger le fichier JavaScript personnalisé
wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);