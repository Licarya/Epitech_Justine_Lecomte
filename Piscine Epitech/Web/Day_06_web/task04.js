module.exports = {

    fizzBuzz: function (num) {
        var x = "";
        for (i = 1; i <= num; i++) {

            if (i % 3 === 0) {
                x = x + "Fizz";
            }

            if (i % 5 === 0) {
                x = x + "Buzz";
            }

            if (i % 5 !== 0 && i % 3 !== 0) {
                x = x + i;
            }

            if (i != num) {
                x = x + ', ';
            }
        }
        console.log (x);
    }
}
