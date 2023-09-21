// MODALE DE CONTACT
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("global-modal");
    const contactButton = document.querySelectorAll(".contact-btn");
    const closeButton = document.querySelector(".modal-close-btn");

    contactButton.forEach((button) => {
      button.addEventListener("click", (e) => {
        modal.classList.add("show"); // Ajoute la classe "show" pour afficher la modal
    });
    });

    modal.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.classList.remove("show"); // Supprime la classe "show" pour cacher la modal
    }
    });

    closeButton.addEventListener("click", () => {
      modal.classList.remove("show"); // Ajout écouteur d'événements pour fermer la modale lorsque le bouton de fermeture est cliqué
    });
});
