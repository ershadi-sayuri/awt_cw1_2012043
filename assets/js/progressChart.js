/**
 * Created by Ershadi Sayuri on 1/13/2016.
 */

$.get("../question/loadProgress", function(result){
    console.log("Data: " + result);
    var jsonData = JSON.parse(result);
    console.log(jsonData.question_status);

    var labelsArray = [];
    var seriesArray = [];
    for (i = 0; i < jsonData.question_status.length; i++) {
        labelsArray.push(jsonData.question_status[i].attempt_id)
        seriesArray.push(parseInt(jsonData.question_status[i].attempt_score))
    }

    var data = {
        // A labels array that can contain any sort of values
        labels: labelsArray,
        // Our series array that contains series objects or in this case series data arrays
        series: [
            seriesArray
        ]
    };

    var options = {
        width: 1000,
        height: 350
    };

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
    new Chartist.Line('.ct-chart', data, options);

});




