<?php
// Template Name: Page d'accueil personnalisée
get_header();
?>

<div class="hero">
    <!-- Code pour le hero -->
    <?php
        $args = array(
            'post_type' => 'portfolio',
            'orderby' => 'rand',
            'posts_per_page' => 1,
        );
        $random_query = new WP_Query($args);

        if ($random_query->have_posts()) :
            while ($random_query->have_posts()) : $random_query->the_post();
            // Récupérer l'URL de l'image à partir des champs personnalisés ou de la taxonomie
            $image_url = get_field('photo')
    ?>
    <?php
        endwhile;
        wp_reset_postdata();
        endif;
    ?>
    <div class="hero-content">
        <?php get_template_part( 'template-parts/photo-block' ); ?>
    </div>
</div>

<div class="photo-list">
    <!-- Code pour la liste de photos -->
    <?php
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
        );
        $photo_query = new WP_Query($args);

        if ($photo_query->have_posts()) :
            while ($photo_query->have_posts()) : $photo_query->the_post();
            // Affichez ici chaque photo individuelle
            endwhile;
            wp_reset_postdata();
        else :
            echo 'Aucune photo trouvée.';
        endif;
    ?>
</div>

<div id="load-more-button">Charger plus</div>

<?php get_footer(); ?>
