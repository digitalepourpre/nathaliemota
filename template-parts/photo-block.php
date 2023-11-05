<img class="photo" src="<?php $photo = the_post_thumbnail_url("large"); ?>" alt="<?php the_title_attribute(); ?>">
<!-- Affiche l'image mise en avant de la publication en tant que miniature, avec l'attribut "alt" contenant le titre de la publication -->

<div class="hover-img">
    <!-- Conteneur pour les éléments d'interaction lorsque survolé -->
    <img class="icon-fullscreen icon-lightbox lightbox-trigger"
        data-photo="<?= the_post_thumbnail_url("large") ?>"
        data-reference="<?= get_field('reference'); ?>"
        data-categorie="<?= get_the_terms(get_the_ID(), 'categorie-photo')[0]->name; ?>"
        src="<?php echo get_template_directory_uri() . '/assets/images/Icon_fullscreen.svg'; ?>"
        alt="Icône Fullscreen">
    <a href="<?php echo get_permalink() ?>">
        <!-- Crée un lien vers la page de la publication actuelle -->
        <img class="hover-eye" src="<?php echo get_template_directory_uri() . '/assets/images/Icon_eye.svg'; ?>" alt="Icône Eye">
        <!-- Affiche une icône d'œil pour indiquer un lien vers la page de la publication -->
    </a>
    <p class="titre-img"><?php the_title(); ?></p>     <!-- Affiche le titre de la publication -->
    <p class="categorie"><?php echo get_the_terms(get_the_ID(), 'categorie-photo')[0]->name; ?></p>     <!-- Affiche la catégorie de la publication -->
</div>
