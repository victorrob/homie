function dropdown(elmnt){
    var style = getComputedStyle(elmnt);
    if(style.backgroundImage === "url(\"http://victor-robert.fr/homie/image/arrowUp.png\")"){
        elmnt.style.backgroundImage = "url(\"http://victor-robert.fr/homie/image/arrowDown.png\")"
    }
    else{
        elmnt.style.backgroundImage = "url(\"http://victor-robert.fr/homie/image/arrowUp.png\")";
    }
}
function send(value){
    document.getElementById('hiddenDelete').value = value;
}
function search(){
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchField");
    filter = input.value.toUpperCase();
    table = document.getElementById("adminTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
var show = ['Propriétaire', 'Invité', 'Installateur', 'Administrateur'];
function select(input){

    var table, tr, td, i;
    table = document.getElementById("adminTable");
    tr = table.getElementsByTagName("tr");
    if(getComputedStyle(input, null).getPropertyValue('border-right-color') !== "rgb(244, 164, 96)"){
        input.style.borderColor = "sandybrown";
        show[show.indexOf('')] = input.innerText;
    }else{
        input.style.borderColor = "transparent";
        show[show.indexOf(input.innerText)] = '';
    }
    for (i = 1; i < tr.length-1; i++) {
        td = document.getElementById("adminSelect" + i);
        if (td) {
            if (show.indexOf(td.options[td.selectedIndex].value) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}