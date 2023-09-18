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
    <p>TOUS DROITS RÉSERVÉS</p>
</footer>

<?php wp_footer(); ?>
