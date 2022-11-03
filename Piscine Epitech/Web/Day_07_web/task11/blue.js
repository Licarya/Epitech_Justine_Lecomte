
// quand on passe au-dessus du paragraphe --> ajout class bleu
// quand on clique sur le paragraphe --> ajoute ou retire la class highlighted

$("p").mouseenter(function () {
    $(this).css("background-color", "blue");
    $(this).addClass("blue");
});

$("p").mouseout(function () {
    $(this).css("background-color", "white");
    $(this).removeClass('blue');
});


    $("p").click(function() {
  $(this).toggleClass("highlighted");
  });

