const div = document.getElementsByTagName("div");
var div1 = div[2];
div1.onclick = function () {
    var name = prompt("What's your name ?");
    if (name == null || name == "") {
        div1.onclick();
    } if (name != null) {
        confirm("Hello " + name + " !");
    }

}