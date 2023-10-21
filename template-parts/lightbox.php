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
?>

<div class="lightbox" id="lightbox-container">

    <div class="lightbox__close btn-close" id="close-lightbox" type="button">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" alt="Croix de fermeture" />
    </div>

    <div class="contener-arrow-left">
        <img class="arrow-left" src="<?php echo get_template_directory_uri() . '/assets/images/precedente.png'; ?> " alt="flèche gauche">
    </div>

    <div class="lightbox__image" id="lightbox-image">
        <img class="photo" src="<?php echo the_post_thumbnail_url("large");?>" alt="<?php the_title_attribute(); ?>">
    </div>

    <div class="contener-arrow-right">
        <img class="arrow-right" src="<?php echo get_template_directory_uri() . '/assets/images/suivante.png'; ?> " alt="flèche droite">
    </div>

</div>
