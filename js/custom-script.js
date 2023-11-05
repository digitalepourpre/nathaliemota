// Attend que le document HTML soit prêt avant d'exécuter le code
jQuery(document).ready(function($) {
// Sur le changement des sélecteurs de catégories, format et date
  jQuery('#categories-select, #format-select, #date-select').on('change',function(){
// Récupère les valeurs sélectionnées dans les menus déroulants
    var categorie = jQuery('#categories-select').val();
    var format = jQuery('#format-select').val();
    var date = jQuery('#date-select').val();
    console.log(format)
// Crée un objet contenant les données à envoyer via AJAX
    var data = {
      action: 'filter_post',
      categorie: categorie,
      format: format,
      date: date 
    };
// Effectue une requête AJAX vers le serveur
    jQuery.ajax({
      type: 'POST',
      url: '/projet11/wp-admin/admin-ajax.php', // URL pour la requête AJAX
      data: data, // Les données à envoyer
      success: function(res) {  // En cas de succès de la requête
        $('.catalogue-photo').html(res); // Remplace le contenu de la classe '.catalogue-photo' avec la réponse reçue
      }
    });
  });
});