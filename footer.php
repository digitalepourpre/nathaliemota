<?php get_template_part( 'template-parts/modale' ); ?>

<div class="lightbox"></div>

<footer id="colophon" class="site-footer">
    <nav id="footer-navigation" class="footer-navigation">
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
