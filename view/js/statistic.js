function onOff(numberSelected, numberMax) {
    var i = 0;
    for (i = 0; i < numberMax; i++) {

        if (i === numberSelected) {

            var div = document.getElementById('sensorValue' + i);
            document.getElementById('sensorValue' + i).style.visibility = (getComputedStyle(div, null).visibility === "hidden") ? "visible" : "hidden";
            document.getElementById('sensorValue' + i).style.position = (getComputedStyle(div, null).position === "relative") ? "absolute" : "relative";
        }
        else {
            document.getElementById('sensorValue' + i).style.visibility = "hidden";
            document.getElementById('sensorValue' + i).style.position = "absolute";
        }
    }
}

var width = 80, heigth = 300, max = 0, historicMax = 0;

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
        document.getElementById("sensorHistoric" + i + j).style.height = Math.floor(heigth * (value / max)) + "px";
        document.getElementById("sensorHistoric" + i + j).style.marginTop = Math.floor(heigth - heigth * (value / max)) + "px";
    }
}


/*
for(j = 0; j < sensorHistoric.length; j++) {
    historicMax = sensorHistoric[j].length;
    max = 0;
    for (i = 0; i < historicMax; i++) {
        document.getElementsByClassName('graph' + j)[i].style.width = (width / historicMax) + '%';
        if (sensorHistoric[j][i] > max && sensorHistoric[j][i]>9) {
            max = sensorHistoric[j][i];
        }
    }
    alert('numbre de val = ' + historicMax + 'max = ' + max);
    for (i = 0; i < historicMax; i++) {
        document.getElementById("sensorHistoric" + j + i).style.height = Math.floor(heigth * (sensorHistoric[j][i] / max)) + "px";
        document.getElementById("sensorHistoric" + j + i).style.marginTop = Math.floor(heigth - heigth * (sensorHistoric[j][i] / max)) + "px";

    }
}
 */