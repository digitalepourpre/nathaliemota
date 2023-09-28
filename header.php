<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="masthead" class="site-header">
        <a href="<?php echo home_url( '/' ); ?>">
            <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/logo/logo.png" alt="logo">
        </a>
        <nav id="site-navigation" class="main-navigation">

            <button id="burger-menu" aria-controls="primary-menu" aria-expanded="false">
			    <img id="burgerImg" src="<?php echo get_template_directory_uri(); ?>/assets/images/burger.svg" alt="Menu">
			    <img id="crossImg" src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" alt="Fermer">
		    </button>

            <div id="fullscreenMenu">
			    <?php
				    wp_nav_menu(
					    array(
						    'theme_location' => 'main',
						    'menu_id'        => 'site__header__menu',
					    )
				    );
			    ?>
		    </div>

            <div class="desktop-menu">
                <?php 
                    wp_nav_menu( 
                        array( 
                            'theme_location' => 'main', 
                            'container' => 'ul',
                            'menu_class' => 'site__header__menu',
                        ) 
                    );
                ?>
            </div>

        </nav>
    </header>