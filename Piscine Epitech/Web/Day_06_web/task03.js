module.exports = {

    countGs: function (str) {
        var x = 0;
        for (i = 0; i < str.length; i++) {
            if (str[i] === "G") {
                x = x + 1;
            }
        }

        return x;
    }
}