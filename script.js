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