<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <a href="<?php echo home_url( '/' ); ?>">
            <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/logo/logo.png" alt="logo">
        </a>
        <nav class="navigation-header">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'main', 
                        'container' => 'ul',
                        'menu_class' => 'site__header__menu',
                    ) 
                );
            ?>
        </nav>
    </header>
    
<?php wp_body_open(); ?>