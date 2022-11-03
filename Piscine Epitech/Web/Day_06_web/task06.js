module.exports = {

    objectsDeeplyEqual: function (cmp1, cmp2) {
        if (JSON.stringify(cmp1) === JSON.stringify(cmp2)){
            return true;
        }else {return false}
    }
}