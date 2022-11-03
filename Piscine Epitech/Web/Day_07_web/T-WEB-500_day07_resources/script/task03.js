const div = document.getElementsByTagName("div");
var div1 = div[2];
var count = "";

document.addEventListener("keypress", write)
 function write(){
    if (count.length < 42) {
        count = count + event.key;
        div1.innerHTML = count;
     
    } else {
     console.log (count.length);
     count = count.substring(1, 42);
     count = count + event.key;
     div1.innerHTML = count;
    }
 }


