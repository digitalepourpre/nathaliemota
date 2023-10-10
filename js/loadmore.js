
// LOAD MORE
jQuery(function($){

    $('.mota_loadmore').click(function(){ //bouton
  
      let button = $(this),
            data = {
                'action': 'loadmore',
                'query': mota_loadmore_params.posts, // params dans wp_localize_script()
                'page' : mota_loadmore_params.current_page
            };
  
      $.ajax({
              url : mota_loadmore_params.ajaxurl,
              data : data,
              type : 'POST',
  
              success : function( data ){
                  if( data ) { 
                      button.text( 'Chargez plus' ).prev().before(data);
                      mota_loadmore_params.current_page++;
   
                      if ( mota_loadmore_params.current_page == mota_loadmore_params.max_page ) 
                          button.remove(); // pas de bouton si tout est chargé
   
                  } else {
                      button.remove();
                  }
              }
          });
      });
  });
  
  // FILTRES
  