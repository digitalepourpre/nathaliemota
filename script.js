// MODALE DE CONTACT
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("global-modal");
    const contactButton = document.querySelectorAll(".contact-btn");

    // Fonction pour ouvrir la modale
function openModal() {
  modal.style.display = "block"; // Affiche la modale
}

// Fonction pour fermer la modale
function closeModal() {
  modal.style.display = "none"; // Cache la modale
}


// Ajout d'un gestionnaire de clic pour chaque bouton de contact
contactButton.forEach((button) => {
  button.addEventListener("click", openModal);
});

// Ajout d'un gestionnaire de clic pour fermer la modale lorsque l'utilisateur clique en dehors
document.addEventListener("click", (event) => {
  if (event.target === modal) {
    closeModal();
  }
});
})

// BURGER MENU
const burgerMenu = document.getElementById("burger-menu");
const fullscreenMenu = document.getElementById("fullscreenMenu");
const burgerImg = document.getElementById("burgerImg");
const crossImg = document.getElementById("crossImg");

burgerMenu.addEventListener("click", () => {
  if (burgerMenu.classList == "activeMenu") {
    fullscreenMenu.style.display = "none";
    burgerImg.style.display = "block";
    crossImg.style.display = "none";
    burgerMenu.classList.remove("activeMenu");
  } else {
    fullscreenMenu.style.display = "block";
    burgerImg.style.display = "none";
    crossImg.style.display = "block";
    burgerMenu.classList.add("activeMenu");
  }
});

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
