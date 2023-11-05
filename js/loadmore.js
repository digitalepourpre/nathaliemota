// LOAD MORE
(function ($) {

  $(document).ready(function () {

    let photosChargées = 0; // Variable pour compter les photos chargées

    // Gestionnaire de clic sur le bouton "Charger plus de photos"
    $(".js-load-photos").click(function (e) {

      // Empêcher l'envoi classique du formulaire
      e.preventDefault();
  
      // L'URL qui réceptionne les requêtes Ajax dans le data
      const ajaxurl = $(this).data("ajaxurl");
  
      // Les données à envoyer dans la requête Ajax
      const data = {
        action: $(this).data("action"),
        nonce: $(this).data("nonce"),
        posttype: $(this).data("posttype"),
      };

      // Requête Ajax en JS natif via Fetch
      fetch(ajaxurl, {
        method: "POST",

        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Cache-Control": "no-cache",
        },

        body: new URLSearchParams(data),
      })

      .then((response) => response.json()) // Traite la réponse comme JSON
      .then((response) => {
  
        // En cas d'erreur
        if (!response.success) {
          alert(response.data); // Affiche un message d'erreur
          return;
        }
  
        // Et en cas de réussite
        if (response.data === "") {

          alert("Toutes les photos sont chargées."); // Message de fin de chargement
          $(".js-load-photos").hide(); // Masque le bouton

        } else {
        // Ajoute les nouvelles photos à la page
          const nouvellesPhotos = $(response.data);
          nouvellesPhotos.addClass("hover-img");
          $(".photo-container").append(response.data);
          photosChargées++; // Incrémente le compteur
        }

      });
    });


});
})(jQuery);
