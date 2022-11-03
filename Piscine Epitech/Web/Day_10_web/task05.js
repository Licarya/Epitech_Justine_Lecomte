$(document).ready(function () {

    $("#type").keyup(function () {
        let valueType = $(this).val();
        $.ajax({
            url: "task05.php",
            data: { type: valueType, input : 1 },
        })
            .done(function (responseType) {
                if (responseType == "ok") {
                    $("#reponseType").css("color", "green");
                } else {
                    $("#reponseType").css("color", "red");
                }

                $("#reponseType").text(responseType);

            })
            .fail(function () {
                alert("error");
            })
    });

    $("#brand").keyup(function () {
        let valueBrand = $(this).val();
        $.ajax({
            url: "task05.php",
            data: { brand: valueBrand,input : 2 },
        })
            .done(function (responseBrand) {
                if (responseBrand == "ok") {
                    $("#reponseBrand").css("color", "green");
                } else {
                    $("#reponseBrand").css("color", "red");
                }

                $("#reponseBrand").text(responseBrand);

            })
            .fail(function () {
                alert("error");
            })
    });

    $("#button").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "task06.php",
            data: { },
        })
            .done(function () {
              alert ("is send");

            })
            .fail(function () {
                alert("error");
            })
    })
});


