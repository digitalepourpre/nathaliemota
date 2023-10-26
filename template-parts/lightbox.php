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
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $reference = get_field('reference'); 
    $taxo_categorie = get_the_terms(get_the_ID(), 'categorie-photo');


    if ($thumbnail_url) {
        $images[] = array(
            'url' => $thumbnail_url,
            'reference' => $reference,
            'categorie' => $taxo_categorie[0]->name
        );
    }
}
?>

<div class="lightbox" id="lightbox-container">

    <div class="lightbox__close btn-close" id="close-lightbox" type="button">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" alt="Croix de fermeture" />
    </div>
    <div class="contener-arrow-right">
        <img class="arrow-right" src="<?php echo get_template_directory_uri() . '/assets/images/suivante.png'; ?> " alt="flèche droite">
    </div>
    <div class="contener-arrow-left">
        <img class="arrow-left" src="<?php echo get_template_directory_uri() . '/assets/images/precedente.png'; ?> " alt="flèche gauche">
    </div>

    <div class="lightbox__image" id="lightbox-image">
    <?php if (!empty($images)): ?>
    <img class="photo" src="<?php echo $images[$image_index]['url']; ?>" alt="">
<?php endif; ?>
        <div class="lightbox_content_image_infos">
            <p class="reference-photo">Référence : <?php echo $reference; ?></p>
            <?php if (!empty($taxo_categorie) && is_array($taxo_categorie)): ?>
    <p class="category-photo">Catégorie : <?php echo $taxo_categorie[0]->name; ?></p>
<?php endif; ?>
        </div>
    </div>

    <div data-image-array="<?php echo json_encode($images); ?>" data-image-index="<?php echo $image_index; ?>"></div>

</div>

<script>
jQuery(document).ready(function($) {
    // Tableau des images et indice de l'image courante
    var images = <?php echo json_encode($images); ?>;
    var image_index = <?php echo $image_index; ?>;

    // Fonction pour afficher les informations de la photo actuelle
    function afficherInformationsPhoto() {
        if (Array.isArray(images) && images.length > 0 && image_index >= 0 && image_index < images.length && images[image_index].url) {
        var image = images[image_index];
        $(".reference-photo").text("Référence : " + image.reference);
        $(".category-photo").text("Catégorie : " + image.categorie);
        $("#lightbox-image img.photo").attr("src", image.url);
    } else {
        // Gérez le cas où les données ne sont pas disponibles
    }
}


    // Lorsque .lightbox-trigger est cliqué
    $(".lightbox-trigger").click(function() {
        // Mettre à jour l'indice de l'image courante
        image_index = $(this).data("image-index");

        // Afficher les informations de la photo dans la lightbox
        afficherInformationsPhoto();

        // Mettre à jour l'image affichée dans la lightbox
        $("#lightbox-image img.photo").attr("src", images[image_index].url);
    });

    // Appeler la fonction pour afficher les informations de la première image
    afficherInformationsPhoto();
});
</script>
