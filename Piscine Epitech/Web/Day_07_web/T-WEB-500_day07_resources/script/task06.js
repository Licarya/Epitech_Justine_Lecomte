const drag = document.getElementsByTagName("canvas")[0];
const div = document.getElementsByTagName("div");
var drop = div[2];
var coor = div[3]
var click = false;

var startx = 0;
var starty = 0;
var stopx = 0;
var stopy = 0;

drag.setAttribute("draggable", "true");

drag.ondragstart = function (event) {
    event.dataTransfer.setData("Text", event.target.id);
    startx = event.pageX;
    starty = event.pageY;
 
};


drop.ondragover = function (event) {
    event.preventDefault();

};

drop.ondrop = function (event) {
    event.preventDefault();
    stopx = event.pageX;
    stopy = event.pageY;
    let x = 0;
    let y = 0
    if (drag.style.left != false) {
    
        x = parseInt(drag.style.left) + (stopx - startx)
        y = parseInt(drag.style.top) + (stopy - starty)
    } else {
        x = stopx - startx
        y = stopy - starty
    }
    drag.style.position = "relative"
    drag.style.top = y + "px"
    drag.style.left = x + "px"
    coor.innerText = "New coordinates => {x:" + x + ", y:" + y + "}"
};