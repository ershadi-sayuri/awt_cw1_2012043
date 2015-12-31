/**
 * Created by Ershadi on 11/14/2015.
 */
function clock(totalSeconds) {
    setInterval(setTime, 1000);
    function setTime() {
        ++totalSeconds;
        $('#seconds').html(passValue(totalSeconds % 60));
        $('#minutes').html(passValue(parseInt(totalSeconds / 60)));
    }
}

function passValue(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    }
    else {
        return valString;
    }
}

function endTime(totalSeconds){
    $('#seconds_f').html(passValue(totalSeconds % 60));
    $('#minutes_f').html(passValue(parseInt(totalSeconds / 60)));
    //sessionStorage.timerTime = 0;
}

function getLastTime() {
    var seconds = $('#seconds').text();
    var minutes = $('#minutes').text();
    var totalSec = Number(seconds) + (Number(minutes) * 60);
    sessionStorage.timerTime = totalSec;
}

$(document).ready(function () {
    if (document.URL.indexOf("loadTenQuestionIds") > 0) {
        sessionStorage.timerTime = 0;
        clock(sessionStorage.timerTime);
    } else if(document.URL.indexOf("question_number=10") > 0 && document.URL.indexOf("answer") > 0 ){
        endTime(sessionStorage.timerTime);
    }else{
        clock(sessionStorage.timerTime);
    }
});
