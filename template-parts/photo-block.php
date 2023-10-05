<img class="photo" src="<?php $photo = the_post_thumbnail_url("large");?>" alt="<?php the_title_attribute(); ?>">
    
    <div class="hover-img">
        <img class="icon-fullscreen icon-lightbox" src="<?php echo get_template_directory_uri() .'/assets/images/Icon_fullscreen.svg';?>" alt="Icône Fullscreen"> 
        <a href="<?php echo get_permalink() ?>"><img class="hover-eye"  src="<?php echo get_template_directory_uri() .'/assets/images/Icon_eye.svg';?>" alt="Icône Eye"> </a>
        <h2 class="reference"><?php echo get_field('reference'); ?></h2>
        <h3 class="categorie"><?php echo get_the_terms(get_the_ID(), 'categorie-photo')[0]->name ?></h3>
    </div>