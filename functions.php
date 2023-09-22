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


add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_650da80a20598',
	'title' => 'Photos',
	'fields' => array(
		array(
			'key' => 'field_650da82ae5388',
			'label' => 'Référence de la photo',
			'name' => 'reference',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'rows' => '',
			'placeholder' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_650da80ae5387',
			'label' => 'Type de photo',
			'name' => 'type',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_650da845e5389',
			'label' => 'Année',
			'name' => 'annee',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => '',
			'max' => '',
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'photo',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 1,
) );
} );

add_action( 'init', function() {
	register_post_type( 'photo', array(
	'labels' => array(
		'name' => 'Photos',
		'singular_name' => 'Photo',
		'menu_name' => 'Photos',
		'all_items' => 'All Photos',
		'edit_item' => 'Modifier Photo',
		'view_item' => 'Voir Photo',
		'view_items' => 'Voir Photos',
		'add_new_item' => 'Ajouter Photo',
		'new_item' => 'Nouveau Photo',
		'parent_item_colon' => 'Photo parent :',
		'search_items' => 'Search Photos',
		'not_found' => 'No photos found',
		'not_found_in_trash' => 'No photos found in Trash',
		'archives' => 'Archives des Photo',
		'attributes' => 'Attributs des Photo',
		'insert_into_item' => 'Insérer dans photo',
		'uploaded_to_this_item' => 'Téléversé sur ce photo',
		'filter_items_list' => 'Filtrer la liste photos',
		'filter_by_date' => 'Filtrer photos par date',
		'items_list_navigation' => 'Navigation dans la liste Photos',
		'items_list' => 'Liste Photos',
		'item_published' => 'Photo publié.',
		'item_published_privately' => 'Photo publié en privé.',
		'item_reverted_to_draft' => 'Photo repassé en brouillon.',
		'item_scheduled' => 'Photo planifié.',
		'item_updated' => 'Photo mis à jour.',
		'item_link' => 'Lien Photo',
		'item_link_description' => 'Un lien vers un photo.',
	),
	'public' => true,
	'show_in_rest' => true,
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'thumbnail',
	),
	'delete_with_user' => false,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'categorie', array(
	0 => 'photo',
), array(
	'labels' => array(
		'name' => 'Categories',
		'singular_name' => 'Categorie',
		'menu_name' => 'Categories',
		'all_items' => 'All Categories',
		'edit_item' => 'Modifier Categorie',
		'view_item' => 'Voir Categorie',
		'update_item' => 'Mettre à jour Categorie',
		'add_new_item' => 'Ajouter Categorie',
		'new_item_name' => 'Nom du nouveau Categorie',
		'search_items' => 'Search Categories',
		'popular_items' => 'Categories populaire',
		'separate_items_with_commas' => 'Séparer les categories avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer categories',
		'choose_from_most_used' => 'Choisir parmi les categories les plus utilisés',
		'not_found' => 'No categories found',
		'no_terms' => 'Aucun categories',
		'items_list_navigation' => 'Navigation dans la liste Categories',
		'items_list' => 'Liste Categories',
		'back_to_items' => '← Aller à « categories »',
		'item_link' => 'Lien Categorie',
		'item_link_description' => 'Un lien vers un categorie',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );

	register_taxonomy( 'format', array(
	0 => 'photo',
), array(
	'labels' => array(
		'name' => 'Formats',
		'singular_name' => 'Format',
		'menu_name' => 'Formats',
		'all_items' => 'All Formats',
		'edit_item' => 'Modifier Format',
		'view_item' => 'Voir Format',
		'update_item' => 'Mettre à jour Format',
		'add_new_item' => 'Ajouter Format',
		'new_item_name' => 'Nom du nouveau Format',
		'search_items' => 'Search Formats',
		'popular_items' => 'Formats populaire',
		'separate_items_with_commas' => 'Séparer les formats avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer formats',
		'choose_from_most_used' => 'Choisir parmi les formats les plus utilisés',
		'not_found' => 'No formats found',
		'no_terms' => 'Aucun formats',
		'items_list_navigation' => 'Navigation dans la liste Formats',
		'items_list' => 'Liste Formats',
		'back_to_items' => '← Aller à « formats »',
		'item_link' => 'Lien Format',
		'item_link_description' => 'Un lien vers un format',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );
} );

