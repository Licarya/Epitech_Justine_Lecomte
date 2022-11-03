const button = document.getElementsByTagName("button");
var btnplus = button[0];
var btnmoins = button[1];
var bod = document.body.style;
var countpage = window.getComputedStyle(document.body, null);

btnplus.onclick = function () {
    var changefont = parseInt(countpage.getPropertyValue("font-size"));
    changefont++;
    changefont = changefont + "px";
    bod.fontSize = changefont;
    console.log(changefont);
}

btnmoins.onclick = function () {
    var changefont = parseInt(countpage.getPropertyValue("font-size"));
    changefont--;
    changefont = changefont + "px";
    bod.fontSize = changefont;
    console.log(changefont);
}



var back = document.getElementsByTagName("select")[0];

back.addEventListener('change', function (changecol) {
    var change = changecol.target.value;
    bod.backgroundColor = change;
});

