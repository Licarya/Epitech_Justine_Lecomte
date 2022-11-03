const div = document.getElementsByTagName("div");
var div1 = div[2];
var count = 0;

div1.onclick = function () {
    count++;
    div1.innerHTML = "click: " + count;
}
