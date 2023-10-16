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

    <button class="lightbox__close btn-close" id="close-lightbox" type="button">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" alt="Croix de fermeture" />
    </button>

    <div class="lightbox__image" id="lightbox-image">

    </div>

</div>
