module.exports = {

    arrayFiltering: function (arr, test) {
        var resu = [];
        
        for (i=0; i< arr.length; i++){
        if (test(arr[i]) == true){
            resu.push(arr[i]);

        }
       }
return resu; 
    }
}
