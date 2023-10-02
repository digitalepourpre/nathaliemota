<div class="bloc-photo">
    <div class="photo1">
        <img src="<?php echo get_random_image_url(); ?>" alt="Image aléatoire 1"></img>
    </div>
    <div class="photo2">
        <img src="<?php echo get_random_image_url(); ?>" alt="Image aléatoire 2"></img>
    </div>
</div>

<?php
// Fonction pour obtenir l'URL d'une image aléatoire depuis la bibliothèque WordPress
function get_random_image_url() {
    $args = array(
        'post_type'      => 'attachment', // Type de contenu pour les médias
        'post_status'    => 'inherit',   // Statut des médias à rechercher
        'orderby'        => 'rand',      // Ordonner de manière aléatoire
        'posts_per_page' => 1,           // Nombre d'images à récupérer (1 pour une seule image aléatoire)
    );

    // Requête pour obtenir une image aléatoire
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            return wp_get_attachment_url(get_the_ID()); // Renvoie l'URL de l'image
        }
    }
}
?>