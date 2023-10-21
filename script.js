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

// LIGHTBOX
var btnFermetureLightbox = $('#close-lightbox');
var dureeTransitionPopup = 1000; 

// Fonction pour effectuer une transition d'affichage avec une opacité donnée
  function transitionPopup(element, opacity) {
    $(element).css('display', opacity === 1 ? 'flex' : 'none');
    $(element).animate({ opacity: opacity }, dureeTransitionPopup);
}

// Lorsqu'on clique sur l'icone fullscreen
$(document).on('click', '.lightbox-trigger', function() {

// On récupére l'URL de l'image sur laquelle l'utilisateur a cliqué
  var urlImage = $(this).data('photo');
  var creerImage = `<img src="${urlImage}" alt="Image agrandie">`;
  $('.lightbox__image').html(creerImage);
  transitionPopup($('.lightbox'), 1); // Affiche la lightbox avec effet de transition
  
});

// Lorsqu'on clique sur le bouton de fermeture de la lightbox
btnFermetureLightbox.click(function() {
  transitionPopup($('.lightbox'), 0); // Ferme la lightbox avec effet de transition
});
