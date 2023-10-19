console.log("coucou")

jQuery(document).ready(function($) {
jQuery('#categories-select, #format-select, #date-select').on('change',function(){
    var categorie = jQuery('#categories-select').val();
    var format = jQuery('#format-select').val();
    var date = jQuery('#date-select').val();
console.log(format)
  var data = {
    action: 'filter_post',
    categorie: categorie,
    format: format,
    date: date // Ajout de la clé 'date' avec la valeur sélectionnée
  };

  jQuery.ajax({
    type: 'POST',
    url: '/projet11/wp-admin/admin-ajax.php',
    data: data,
    success: function(res) {
      $('.catalogue-photo').html(res);
    }
  });
});
});