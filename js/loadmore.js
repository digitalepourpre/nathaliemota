
// LOAD MORE
(function ($) {
    $(document).ready(function () {
        let photosChargées = 0;
      // Chargment des commentaires en Ajax
      $(".js-load-photos").click(function (e) {
        // Empêcher l'envoi classique du formulaire
        e.preventDefault();
  
        // L'URL qui réceptionne les requêtes Ajax dans le data
        const ajaxurl = $(this).data("ajaxurl");
  
        // Les data du bouton
        // ⚠️ Ne changez pas le nom "action" !
        const data = {
          action: $(this).data("action"),
          nonce: $(this).data("nonce"),
          posttype: $(this).data("posttype"),
        };
  
        // Pour vérifier qu'on a bien récupéré les données
        console.log(ajaxurl);
        console.log(data);
  
        // Requête Ajax en JS natif via Fetch
        fetch(ajaxurl, {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "Cache-Control": "no-cache",
          },
          body: new URLSearchParams(data),
        })
          .then((response) => response.json())
          .then((response) => {
            console.log(response);
  
            // En cas d'erreur
            if (!response.success) {
              alert(response.data);
              return;
            }
  
             // Et en cas de réussite
             if (response.data === "") {
                alert("Toutes les photos sont chargées."); // Message de fin de chargement
                $(".js-load-photos").hide(); // Masque le bouton
            } else {
                $(".catalogue-photo").append(response.data);
                photosChargées++; // Incrémente le compteur
            }
        });
      });
});
})(jQuery);