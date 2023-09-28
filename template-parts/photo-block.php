<?php
// catégorie de la photo en cours
$categories = get_the_terms(get_the_ID(), 'categorie-photo');

if ($categories && !is_wp_error($categories)) {
    $category_ids = wp_list_pluck($categories, 'term_id');
    $category_id = implode(',', $category_ids);

    // Affiche deux photos de la même catégorie
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 2,
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie-photo',
                'field' => 'id',
                'terms' => $category_id,
            ),
        ),
        'post__not_in' => array(get_the_ID()), // Exclure le contenu actuel
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            ?>
            <div class="suggestion-photo-block">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>">
                </a>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </div>
            <?php
        endwhile;
    endif;

    wp_reset_postdata();
}
?>
