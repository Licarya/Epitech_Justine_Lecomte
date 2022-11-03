module.exports = {

    range: function (start, end, step = 1) {
        var result = [];

        if (start < end) {
            for (i = start; i <= end; i = i + step) {
                result.push(i);
            }
        }

        if (start > end) {
            for (i = start; i >= end; i = i + step) {
                result.push(i);
            }
        }
        return result;

    }
}
