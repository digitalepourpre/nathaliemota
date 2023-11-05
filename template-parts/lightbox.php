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
$images = array(); // tableau vide pour stocker les URL des images
$image_index = 0; // indice d'image à 0

// La boucle ci-dessous récupère les images du contenu et les ajoute au tableau d'images
while (have_posts()) {
    the_post();
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large'); // Récupère l'URL de l'image à partir de la miniature de publication
    $reference = get_field('reference'); // Récupère la référence de l'image
    $taxo_categorie = get_the_terms(get_the_ID(), 'categorie-photo'); // Récupère la catégorie de l'image

    if ($thumbnail_url) {
        // Si une URL d'image est disponible, l'ajoute au tableau d'images avec la référence et la catégorie
        $images[] = array(
            'url' => $thumbnail_url,
            'reference' => $reference,
            'categorie' => $taxo_categorie[0]->name
        );
    }
}
?>

<div class="lightbox" id="lightbox-container">
    <!-- La div pour afficher la lightbox avec les images -->

    <div class="lightbox__close btn-close" id="close-lightbox" type="button">
        <!-- Bouton de fermeture de la lightbox avec une croix -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" alt="Croix de fermeture" />
    </div>
    <div class="contener-arrow-right">
        <!-- Conteneur pour la flèche droite de navigation -->
        <img class="arrow-right" src="<?php echo get_template_directory_uri() . '/assets/images/suivante.png'; ?> " alt="flèche droite">
    </div>
    <div class="contener-arrow-left">
        <!-- Conteneur pour la flèche gauche de navigation -->
        <img class="arrow-left" src="<?php echo get_template_directory_uri() . '/assets/images/precedente.png'; ?> " alt="flèche gauche">
    </div>

    <div class="lightbox__image" id="lightbox-image">
        <!-- Conteneur pour afficher l'image dans la lightbox -->
        <img class="photo" src="<?php echo $images[$image_index]['url']; ?>" alt="">
        <!-- L'image à afficher dans la lightbox -->
    </div>

    <div id="reference-photo"></div>
    <div id="categorie-photo"></div>

    <div data-image-array="<?php echo json_encode($images); ?>" data-image-index="<?php echo $image_index; ?>"></div>
    <!-- Les données de l'image, telles que le tableau JSON des images et l'indice actuel -->

</div>
