<?php

/**
 * Template Name: Template Single
 *
 * @package WordPress
 * @subpackage Nathalie Mota Photographe Event
 **/

get_header(); ?>

<?php 
    // Champs ACF
    $titre = get_field('nom'); 
    $type = get_field('type');
    $annee = get_field('annee');
	$photo_url = get_field('photo');
    $reference = get_field('reference'); 

    // Champs de Taxonomies
    $taxo_categorie = get_the_terms(get_the_ID(), 'categorie-photo'); 
    $taxo_format = get_the_terms(get_the_ID(), 'format-photo'); 

    //Récupération de l'id et de l'url	
	$id = get_the_ID();
    $url = get_permalink();

    //Flèches précédent et suivant
	$nextPost = get_next_post();
    $previousPost = get_previous_post();
?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); //boucle qui affiche le contenu de la page tant qu'il y a des articles à afficher?>

<div class="container-simple">

    <div  class="informations-photo">

      	<div class="informations"> 
			<h2><?php  the_title(); ?></h2>
			<p> RÉFÉRENCE :  <span class="reference-photo"><?php echo $reference ?></span></p>
			<p> CATÉGORIE :  <?php echo $taxo_categorie[0]->name ?></p>
			<p> FORMAT :     <?php echo $taxo_format[0]->name ?></p>
			<p> TYPE :       <?php echo $type ?>   </p>
			<p> ANNÉE :      <?php echo $annee ?></p>
		</div>

		<div class="affichage-photo">
			<img class ="single-photo"  src="<?php echo $photo_url ?>" alt="<?php the_title_attribute(); ?>">
			
			<div class="hover-img">
				<img class="hover-fullscreen icon-lightbox lightbox-trigger" src="<?php echo get_template_directory_uri() .'/assets/images/Icon_fullscreen.svg';?>" alt="Icône d'affiche en plein écran"> 
			</div>

		</div>

	</div>

	<div class="contact-menu">
		
		<div class="container-contact">
			<p> Cette photo vous intéresse ? </p>
			<button class="button-contact contact-link">Contact</button>
		</div>

		<div class="container-arrows"> 
			<?php 
				$args = array( 
					'post_type' => 'portfolio',
					'posts_per_page' => 2,
				);
			?>

			<div class="navigation-arrows">
				<?php if (!empty($previousPost)){ ?>
				<div class="container-image-arrows"> 
					<?php echo get_the_post_thumbnail ($previousPost->ID, 'thumbnail', ['class'=>"img-arrows"])?>
				</div>
				<a href="<?php echo get_permalink($previousPost->ID) ?>"><img class="arrow" src="<?php echo get_template_directory_uri() .'/assets/images/left-arrow.svg';?>" alt="Flèche précédent"></a>
				<?php } ?>
				<?php if (!empty($nextPost)){ ?>   
				<a href="<?php echo get_permalink($nextPost->ID) ?>"><img class="arrow" src="<?php echo get_template_directory_uri() .'/assets/images/right-arrow.svg';?>" alt="Flèche suivant"></a>   
				<?php } ?>
			</div>

		</div>

	</div>
	
	<h3> VOUS AIMEREZ AUSSI</h3>

	<div class="container-similar-img">

        <?php
            $imageSimilaire = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie-photo',
                        'field' => 'term_id',
                        'terms' => $taxo_categorie[0]->term_id,
                    ),
                ),
                'post__not_in' => array($id),
                'orderby' => 'rand',
            );

            $query = new WP_Query($imageSimilaire);

            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
				
		<div class ="container-similar-photo" >
			<?php get_template_part('/template-parts/photo-block'); ?>
		</div>
				
		<?php endwhile;
		    else :
			$response = 'Il n\'y a pas de photos similaires dans cette catégorie.';
			echo $response;
		    endif;
		    wp_reset_postdata();
		?>
	
	</div>
	
	<div class="container-all">
		<button class="button-single" type="button" onclick="window.location.href='<?php echo home_url(); ?>'"> Toutes les photos </button> 
	</div>
</div>

<?php endwhile; endif ?> 

<script>
jQuery(document).ready(function($) {
    // Cibler le bouton "Contact" et gérer le clic
    $(".button-contact").click(function() {
        // Récupérer la référence de la photo actuellement affichée
        var reference = $(".reference-photo").text();
        
        // Pré-remplir le champ "RÉF" du formulaire avec la référence
        $("[name='reference']").val(reference);
        
        // Ouvrir la popup
        $("#global-modal").show();
    });
    
    // Fermer la popup lorsque l'utilisateur clique en dehors du contenu
    $(document).mouseup(function(e) {
        var modal = $("#contact-modal");
        if (!modal.is(e.target) && modal.has(e.target).length === 0) {
            modal.closest(".modal").hide();
        }
    });
});
</script>


<?php get_footer() ?>