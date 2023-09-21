<?php get_template_part( 'template-parts/modale' ); ?>

<footer class="site__footer">
    <nav class="navigation-footer">
    <?php 
        wp_nav_menu( 
            array( 
                'theme_location' => 'footer', 
                'container' => 'ul',
                'menu_class' => 'site__footer__menu',
            ) 
        );
    ?>
    </nav>
</footer>

<?php wp_footer(); ?>
