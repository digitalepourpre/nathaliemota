<img class="photo" src="<?php $photo = the_post_thumbnail_url("large"); ?>" alt="<?php the_title_attribute(); ?>">

<div class="hover-img">
    <img class="icon-fullscreen icon-lightbox lightbox-trigger"
        data-photo="<?= the_post_thumbnail_url("large") ?>"
        data-reference="<?= get_field('reference'); ?>"
        data-categorie="<?= get_the_terms(get_the_ID(), 'categorie-photo')[0]->name; ?>"
        src="<?php echo get_template_directory_uri() . '/assets/images/Icon_fullscreen.svg'; ?>"
        alt="Icône Fullscreen">
    <a href="<?php echo get_permalink() ?>">
        <img class="hover-eye" src="<?php echo get_template_directory_uri() . '/assets/images/Icon_eye.svg'; ?>" alt="Icône Eye">
    </a>
    <p class="titre-img"><?php the_title(); ?></p>
    <p class="categorie"><?php echo get_the_terms(get_the_ID(), 'categorie-photo')[0]->name; ?></p>
</div>
