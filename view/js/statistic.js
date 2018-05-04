var width = 95, heigth = 300, max = 0, historicMax = 0;
var j = 0;
var i = 0;
var timeRangeSelected;
for(i = 0; i <sensorType.length; i++){
    selectTimeRange(4,i);
}
//onmouse function
function showValue(i, j, set){
    var valueDiv = document.getElementById("showValue" + i);
    var tri = document.getElementById("triangle" + i);
    if(set){
        valueDiv.innerText = 'date : ' + sensorHistoric[sensorType[i]]['day'][j] + '\n' +
            'valeur : ' + Math.floor(sensorHistoric[sensorType[i]]['value'][j] * 100)/100;
        var div = document.getElementById("sensorHistoric" + i + "+" + j);
        var divW = getComputedStyle(div).getPropertyValue("width");
        var divL = div.offsetLeft;
        var divT = div.offsetTop;

        tri.style.left = (divL + divW.slice(0,divW.length -2)/2) + "px";
        tri.style.top = (divT-14) + "px";
        tri.style.visibility = "visible";

        valueDiv.style.top = (divT - 23) + "px";
        valueDiv.style.left = (divL + divW.slice(0,divW.length -2)/2) + "px";
        valueDiv.style.visibility = "visible";
    }
    else{
        valueDiv.style.visibility = "hidden";
        tri.style.visibility = "hidden";
    }
}

//onclick functions

//choose time range of graph
function selectTimeRange(timeRangeSel, i){
    timeRangeSelected = timeRangeSel;
    var fiveYears = document.getElementById("5years" + i);
    var year = document.getElementById("1year" + i);
    var sixMonth = document.getElementById("6month" + i);
    var thirtyDays = document.getElementById("30days" + i);
    var sevenDays = document.getElementById("7days" + i)
    var all = [fiveYears,year,sixMonth,thirtyDays, sevenDays];
    var selected = all[timeRangeSelected];
    selected.style.border = "1px solid white";
    for(j=0; j<all.length; j++){
        if(all[j] !== selected){
            all[j].style.border = "none";
        }
    }

    mean(i);
    graphDisplay(i);
}

function mean(i){
    var size = [5, 12, 6, 30, 7][timeRangeSelected];
    var type = [0,1,1,2,2][timeRangeSelected];
    var list = sensorHistoricOriginal[sensorType[i]];
    var endDate = setDate(list['day'][list['value'].length - 1].split("-")[type], new Date());
    var average = 0;
    var count = 0;
    var newList = {'value' : [],
        'day' : []};
    var value = true;
    for(j = list['value'].length - 1; j>=0; j--) {
        if (parseInt(list['day'][j].split("-")[type]) === getDate(endDate)[0]) {
            average += parseInt(list['value'][j]);
            count++;
            value = true;
        }
        else if (size - 1 > newList['value'].length) {
            newList['value'].unshift(average / count);
            newList['day'].unshift(getDate(endDate)[1]);
            endDate = setDate(list['day'][j].split("-")[type], endDate);
            average = parseInt(list['value'][j]);
            count = 1;
        } else {
            break;
        }
    }
    newList['value'].unshift(average/count);

    newList['day'].unshift(getDate(endDate)[1]);
    endDate = setDate(list['day'][list['value'].length - 1].split("-")[type], endDate);
    j = 1;
    var lastDate = parseInt(newList['day'][newList['day'].length-1].split("-")[0]);

    while(size > newList['value'].length){
        newList['value'].unshift(0);
        endDate = setDate(lastDate-j,endDate);
        newList['day'].unshift(getDate(endDate)[1]);
        j++;
    }

    sensorHistoric[sensorType[i]] = newList;

}

function setDate(newDate, endDate){
    switch (timeRangeSelected){
        case 0:
            endDate.setFullYear(newDate);
            break;
        case 1:
        case 2:
            endDate.setMonth(newDate-1);
            break;
        case 3:
        case 4:
            endDate.setDate(newDate);
            break;
    }
    return endDate;
}

function getDate(endDate){
    switch (timeRangeSelected){
        case 0:
            return [endDate.getFullYear(), endDate.getFullYear().toString()];
        case 1:
        case 2:
            return [endDate.getMonth()+1, (endDate.getMonth()+1) + '-' + endDate.getFullYear()];
        case 3:
        case 4:
            return [endDate.getDate(), endDate.getDate() + '-' + (endDate.getMonth()+2) + '-' + endDate.getFullYear().toString().split('20')[1]];
    }
}

function graphDisplay(i) {
    historicMax = sensorHistoric[sensorType[i]]['value'].length;
    max = 0;
    var maxDiv = Math.max(sensorHistoric[sensorType[i]]['value'].length, 30);
    var date, div;
    var value;
    for (j = 0; j < maxDiv; j++) {
        div = document.getElementById('sensorHistoric' + i + '+' + j);
        date = document.getElementById('date' + i + '+' + j);
        if(j<sensorHistoric[sensorType[i]]['value'].length) {
            value = sensorHistoric[sensorType[i]]['value'][j];
            div.style.width = (width / historicMax) + '%';
            if (value > max && value > 9) {
                max = value;
            }
            div.style.visibility = "visible";
            div.style.position = "relative";
            date.style.visibility = "visible";
            date.style.position = "relative";
        }else{
            div.style.visibility = "hidden";
            div.style.position = "absolute";
            date.style.visibility = "hidden";
            date.style.position = "absolute";
        }
    }

    for (j = 0; j < sensorHistoric[sensorType[i]]['value'].length; j++) {
        div = document.getElementById('sensorHistoric' + i + '+' + j);
        date = document.getElementById('date' + i + '+' + j);
        value = sensorHistoric[sensorType[i]]['value'][j];
        div.style.height = Math.floor(heigth * (value / max)) + "px";
        div.style.marginTop = Math.floor(heigth - heigth * (value / max)) + "px";
        date.style.marginTop = Math.floor(330 - (heigth - heigth * (value / max))) + "px";
        //date.innerText = 'date : ' + sensorHistoric[sensorType[i]]['day'][j] + '\n' +
           // 'valeur : ' + sensorHistoric[sensorType[i]]['value'][j];
    }
    document.getElementById("maxValue" + i).innerText = max;
    document.getElementById("meanValue" + i).innerText = "" + Math.floor(max / 2);
}

// show graph
function onOff(numberSelected, numberMax) {
    for (i = 0; i < numberMax; i++) {
        var div = document.getElementById('sensorValue' + i);
        if (i === numberSelected) {
            document.getElementsByClassName('graphSection')[i].style.width = (getComputedStyle(document.getElementsByClassName('graphSection')[i], null).width === "0px") ? "auto" : "0";
            /*div.style.visibility = (getComputedStyle(div, null).visibility === "hidden") ? "visible" : "hidden";
            div.style.position = (getComputedStyle(div, null).position === "relative") ? "fixed" : "relative";*/
            div.style.display = (getComputedStyle(div, null).display === "flex") ? "none" : "flex";
        }
        else {
            document.getElementsByClassName('graphSection')[i].style.width = "0px";
            div.style.display = "none";
        }
    }
}