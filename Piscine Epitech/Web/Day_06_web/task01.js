module.exports = {

    drawTriangle: function (height) {
        let draw = "";
        for (let i = 0; i < height; i++) {
            draw = draw + "$";
            console.log(draw);
        }
    }
}