function start(){
	var parametre = ["name","firstName","birth","email","address","phone","password"];
	for (var i = parametre.length - 1; i >= 0; i--) {
		console.log("création du bouton : " + parametre[i]);
		button(parametre[i]);
		display(parametre[i]);
		display(parametre[i]);
		
	}
}

function display(id){
	if (id =="password"|| id=="email"){
		display(id+"1");
		display(id+"2");
	}else{

		console.log("try : moddifiquation du display de : " + id);
		var id = id + "Modif";
		var doc = document.getElementById(id);
		if (doc.style.display == "inline"){
			doc.style.display = "none";
		}else{
			doc.style.display = "inline";
		}
		console.log("moddifiquation du display de : " + id);
	}
}
function button(element){
	var id = element;
	var buttonName = element + "Button";
	var btn = document.getElementById(buttonName);
	btn.onclick = function(){display(id);};
	console.log("bouton "+element +" crée");
}
function verif(){

}
function verfMail(mail){
	var iarg1 = 0;
	var iarg2 = 0;
	for (var i = 0; i < mail.length; i++) {
		if(mail[i]=='@'){
			iarg1 = i;

		}
		if(mail[i] == '.'){
			iarg2 = i;
		}
	}
	if (iarg1>=2 && ((iarg2-iarg1)>2) && ((mail.length-iarg2)>2)) {
		return true;
	}
	return false;
}
function verfTel(tel) {
	var number='0123456789';
	if(tel.length==10){
		for (var i = 0; i < 10; i++) {
			if (charIsIn(tel[i],number)) {
				return true;
			}
		}
	}
	return false;
}
function charIsIn(char,list){
	for (var i = 0; i < list.length; i++) {
		if(char == list[i]){
			return true;
		}
	}
	return false;
}