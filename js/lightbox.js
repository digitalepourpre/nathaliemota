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
        var creerImage = `<img src="${urlImage}" alt="Image agrandie">`;
        $('.lightbox__image').html(creerImage);
          
        // Récupérer les attributs data-photo, data-reference et data-categorie
        var reference = $(this).data('reference');
        var categorie = $(this).data('categorie');
          
        // Afficher la référence et la catégorie dans la lightbox
        $('.reference-photo').text('Référence : ' + reference);
        $('.category-photo').text('Catégorie : ' + categorie);
          
        // Remplace les attributs data-image-array et data-image-index
        imagesLightbox = $('.photo').map(function() {
            return $(this).attr('src');
        }).get();
        currentIndex = imagesLightbox.indexOf(urlImage);
          
        transitionPopup($('.lightbox'), 1);
          
    });
      
    // Lorsqu'on clique sur le bouton de fermeture de la lightbox
    btnFermetureLightbox.click(function() {
        transitionPopup($('.lightbox'), 0);
    });
      
    // Lorsqu'on clique sur la flèche droite
    btnImageSuivante.click(function() {
        if (currentIndex < imagesLightbox.length - 1) {
            currentIndex++;
            var creerImage = `<img src="${imagesLightbox[currentIndex]}" alt="Image agrandie">`;
            $('.lightbox__image').html(creerImage);
              
            // Récupérer les attributs data-reference et data-categorie de l'image actuelle
            var reference = $('.lightbox-trigger').eq(currentIndex).data('reference');
            var categorie = $('.lightbox-trigger').eq(currentIndex).data('categorie');
              
            // Afficher la référence et la catégorie de l'image actuelle
            $('.reference-photo').text('Référence : ' + reference);
            $('.category-photo').text('Catégorie : ' + categorie);
              
        }
    });
      
    // Lorsqu'on clique sur la flèche gauche
    btnImagePrecedente.click(function() {
        if (currentIndex > 0) {
            currentIndex--;
            var creerImage = `<img src="${imagesLightbox[currentIndex]}" alt="Image agrandie">`;
            $('.lightbox__image').html(creerImage);
              
            // Récupérer les attributs data-reference et data-categorie de l'image actuelle
            var reference = $('.lightbox-trigger').eq(currentIndex).data('reference');
            var categorie = $('.lightbox-trigger').eq(currentIndex).data('categorie');
              
            // Afficher la référence et la catégorie de l'image actuelle
            $('.reference-photo').text('Référence : ' + reference);
            $('.category-photo').text('Catégorie : ' + categorie);
              
        }
    });

});