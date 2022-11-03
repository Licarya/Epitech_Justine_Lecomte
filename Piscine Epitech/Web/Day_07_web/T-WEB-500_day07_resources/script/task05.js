
const play = document.getElementsByTagName("canvas")[0];

var context = play.getContext('2d');
context.beginPath();
context.moveTo(6, 6);
context.lineTo(14, 10);
context.lineTo(6, 14);
context.closePath();
context.fillStyle = "white";
context.fill();


var audio = new Audio('https://file-examples.com/storage/fe783a5cbb6323602a28c66/2017/11/file_example_MP3_700KB.mp3');
play.onclick = function () {
    audio.play();
}

const btn = document.getElementsByTagName("button");
var btnpause = btn[0];
var btnstop = btn[1];
var btnmute = btn[2];
console.log(btn);

btnpause.onclick = function() {
    audio.pause();
}

btnstop.onclick = function() {
    audio.pause();
    audio.currentTime = 0;
}

btnmute.onclick = function() {
    if(audio.muted != true){
         audio.muted = true;
    } 
    else{
       audio.muted = false;
    }
   
}