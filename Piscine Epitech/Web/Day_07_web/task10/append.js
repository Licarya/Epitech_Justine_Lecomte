
// a chaque click avec contenu dans le champ comme paramètre
// ajoute une div APRES le champ avec le contenu du param

    $("button").click(function () {
        var field = $("#listItem").val();
        $("<div>"+field+"</div>").insertAfter("#listItem");
    });