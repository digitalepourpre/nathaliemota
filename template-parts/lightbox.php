<div class="lightbox">

  <button class="lightbox__close">Fermer</button>
  <button class="lightbox__next">Suivant</button>
  <button class="lightbox__prev">Précédent</button>

  <div class="lightbox__container">
    <img src="<?php $photo = the_post_thumbnail_url("large");?>" alt="<?php the_title_attribute(); ?>">
  </div>

</div>