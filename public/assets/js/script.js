function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

R = "";
T = "";

domReady(function() {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        // alert("You Qr is : " + decodeText, decodeResult);
        T = decodeText;
        R = decodeResult
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader", {
            fps: 10,
            qrbos: 250
        }
    );
    htmlscanner.render(onScanSuccess);
});

$.ajax({
    type: "POST", // ou "GET" selon vos besoins
    url: "/scan_code_barre",
    data: {
        decodeResult: R,
        decodeText: T
    },
    success: function(response) {
        // Gérer la réponse du serveur si nécessaire
        console.log(response);
    }
});

$(document).ready(function() {
    // Écoutez les changements dans la sélection de médicaments
    $('#exampleFormControlSelect1').change(function() {
        // Supprimez d'abord tous les champs de saisie de quantité existants
        $('#quantiteFields').empty();

        // Pour chaque mé   dicament sélectionné
        $('#exampleFormControlSelect1 option:selected').each(function() {
            // Créez un champ de saisie de quantité correspondant
            var quantite = $(this).data('quantite');
            var quantiteField = $('<input type="number" max = ' +
                quantite + ' class = "form-control mb-1" placeholder = "Quantité pour ' + $(this).text() + '"name = "quantite[' + $(this).val() + ']" > ');

            // Ajoutez le champ de saisie de quantité à la zone de quantité
            $('#quantiteFields').append(quantiteField);
        });
    });
});

$(document).ready(function() {
    $('.js-example-basic-single').select2({
        width: '100%', // Définir la largeur
        placeholder: 'Sélectionnez un médicament', // Texte de l'option par défaut
        allowClear: true, // Activer l'option de suppression de la sélection
        // minimumInputLength: 2 // Nombre minimum de caractères pour déclencher la recherche
    });
});