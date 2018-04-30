var width = 95, heigth = 300, max = 0, historicMax = 0;

var i=0,j=0;

for(i = 0; i < sensorType.length; i++){
    historicMax = sensorHistoric[sensorType[i]]['value'].length;
    max = 0;
    for(j = 0; j<sensorHistoric[sensorType[i]]['value'].length; j++){
        var value = sensorHistoric[sensorType[i]]['value'][j];
        document.getElementsByClassName('graph' + i)[j].style.width = (width / historicMax) + '%';
        if (value > max && value>9) {
            max = value;
        }
    }

    for(j = 0; j<sensorHistoric[sensorType[i]]['value'].length; j++){
        value = sensorHistoric[sensorType[i]]['value'][j];
        document.getElementById("sensorHistoric" + i + '+' + j).style.height = Math.floor(heigth * (value / max)) + "px";
        document.getElementById("sensorHistoric" + i + '+' + j).style.marginTop = Math.floor(heigth - heigth * (value / max)) + "px";
    }
}

function showValue(i, j, event, set){
    if(null === document.getElementById('idValue')){

        var valueDiv = document.createElement('div');
        valueDiv.id = 'idValue';
        document.getElementById('statisticSection').appendChild(valueDiv);
    }
    else{
        var valueDiv = document.getElementById('idValue');
    }
    if(set){
        valueDiv.innerText = sensorHistoric[sensorType[i]]['value'][j];
        valueDiv.style.left = (event.screenX + 'px');
        valueDiv.style.top = (event.clientY + 'px');
        valueDiv.style.visibility = "visible";
    }
    else{
        valueDiv.style.visibility = "hidden";
    }
}

function onOff(numberSelected, numberMax) {
    var i = 0;
    for (i = 0; i < numberMax; i++) {

        if (i === numberSelected) {

            var div = document.getElementById('sensorValue' + i);
            document.getElementById('sensorValue' + i).style.visibility = (getComputedStyle(div, null).visibility === "hidden") ? "visible" : "hidden";
            document.getElementById('sensorValue' + i).style.position = (getComputedStyle(div, null).position === "relative") ? "fixed" : "relative";
        }
        else {
            document.getElementById('sensorValue' + i).style.visibility = "hidden";
            document.getElementById('sensorValue' + i).style.position = "fixed";
        }
    }
}