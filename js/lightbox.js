// Attend que le document HTML soit prêt avant d'exécuter le code
jQuery(document).ready(function($) {
// Sélectionne les éléments du DOM pour les boutons de fermeture, flèche droite et flèche gauche
  var btnFermetureLightbox = $('#close-lightbox');
  var btnImageSuivante = $('.contener-arrow-right');
   var btnImagePrecedente = $('.contener-arrow-left');
// Durée de la transition d'affichage de la lightbox en millisecondes
  var dureeTransitionPopup = 1000;
      
// Crée un tableau vide pour stocker les images de la lightbox
  var imagesLightbox = [];
  var currentIndex = 0; // Index de l'image actuellement affichée
      
// Fonction pour effectuer une transition d'affichage avec une opacité donnée
  function transitionPopup(element, opacity) {
    $(element).css('display', opacity === 1 ? 'flex' : 'none');
    $(element).animate({ opacity: opacity }, dureeTransitionPopup);
  }
      
// Lorsqu'on clique sur une miniature (élément avec la classe 'lightbox-trigger')
  $(document).on('click', '.lightbox-trigger', function() {
// Récupère l'URL de l'image à afficher depuis l'attribut 'data-photo'
    var urlImage = $(this).data('photo');
// Mise à jour des informations sur l'image (référence et catégorie)
    $('#reference-photo').html($(this).data('reference'));
    $('#categorie-photo').html($(this).data('categorie'));
// Crée une balise <img> avec l'URL de l'image et l'affiche dans la lightbox
    var creerImage = `<img src="${urlImage}" alt="Image agrandie">`;
    $('.lightbox__image').html(creerImage);
    
// Remplace les attributs data-image-array et data-image-index
    images = $('.photo').map(function() {
      return $(this).attr('src');
    }).get();
    currentIndex = images.indexOf(urlImage);
// Affiche la lightbox avec une transition d'opacité
    transitionPopup($('.lightbox'), 1);
  });
    
// Lorsqu'on clique sur le bouton de fermeture de la lightbox
  btnFermetureLightbox.click(function() {
// Masque la lightbox avec une transition d'opacité
    transitionPopup($('.lightbox'), 0);
  });
    
// Lorsqu'on clique sur la flèche droite
  btnImageSuivante.click(function() {
    if (currentIndex < images.length - 1) {
      currentIndex++; // Incrémente l'indice de l'image
      var creerImage = `<img src="${images[currentIndex]}" alt="Image agrandie">`;
      $('.lightbox__image').html(creerImage);
    }
  });
    
// Lorsqu'on clique sur la flèche gauche
  btnImagePrecedente.click(function() {
    if (currentIndex > 0) {
      currentIndex--; // Décrémente l'indice de l'image
      var creerImage = `<img src="${images[currentIndex]}" alt="Image agrandie">`;
      $('.lightbox__image').html(creerImage);
    }
  });
    
});