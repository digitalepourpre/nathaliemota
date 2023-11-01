jQuery(document).ready(function($) {
    var btnFermetureLightbox = $('#close-lightbox');
    var btnImageSuivante = $('.contener-arrow-right');
    var btnImagePrecedente = $('.contener-arrow-left');
    var dureeTransitionPopup = 1000;
      
    // Les images du lightbox
    var imagesLightbox = [];
    var currentIndex = 0;
      
    // Fonction pour effectuer une transition d'affichage avec une opacité donnée
    function transitionPopup(element, opacity) {
        $(element).css('display', opacity === 1 ? 'flex' : 'none');
        $(element).animate({ opacity: opacity }, dureeTransitionPopup);
    }
      
    // Lorsqu'on clique sur l'icone fullscreen
    $(document).on('click', '.lightbox-trigger', function() {
        var urlImage = $(this).data('photo');
        $('#reference-photo').html($(this).data('reference'));
        $('#categorie-photo').html($(this).data('categorie'));
        var creerImage = `<img src="${urlImage}" alt="Image agrandie">`;
        $('.lightbox__image').html(creerImage);
    
        // Remplace les attributs data-image-array et data-image-index
        images = $('.photo').map(function() {
          return $(this).attr('src');
        }).get();
        currentIndex = images.indexOf(urlImage);
    
        transitionPopup($('.lightbox'), 1);
    
        // Débogage
        console.log('URL de l\'image :', urlImage);
        console.log('Images :', images);
        console.log('Indice actuel :', currentIndex);
      });
    
      // Lorsqu'on clique sur le bouton de fermeture de la lightbox
      btnFermetureLightbox.click(function() {
          transitionPopup($('.lightbox'), 0);
      });
    
      // Lorsqu'on clique sur la flèche droite
      btnImageSuivante.click(function() {
        if (currentIndex < images.length - 1) {
          currentIndex++;
          var creerImage = `<img src="${images[currentIndex]}" alt="Image agrandie">`;
          $('.lightbox__image').html(creerImage);
    
          // Débogage
          console.log('Indice après clic droit :', currentIndex);
        }
      });
    
      // Lorsqu'on clique sur la flèche gauche
      btnImagePrecedente.click(function() {
        if (currentIndex > 0) {
          currentIndex--;
          var creerImage = `<img src="${images[currentIndex]}" alt="Image agrandie">`;
          $('.lightbox__image').html(creerImage);
    
          // Débogage
          console.log('Indice après clic gauche :', currentIndex);
        }
      });
    
    });