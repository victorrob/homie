function start(){
	var parametre = ["name","firstName","birth","email","address","phone","password"];
	for (var i = parametre.length - 1; i >= 0; i--) {
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
		var id = id + "Modif";
		var doc = document.getElementById(id);
		if (doc.style.display == "inline"){
			doc.style.display = "none";
		}else{
			doc.style.display = "inline";
		}
	}
}
function button(element){
	var id = element;
	var buttonName = element + "Button";
	var btn = document.getElementById(buttonName);
	btn.onclick = function(){display(id);};}
function verif(){

}
function verfMail(mail){
	var iarg1 = 0;
	var iarg2 = 0;
	if(mail == ''){
		return true;
	}
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
	if(tel == ''){
		return true;
	}
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
function checkForm(){
	var tel = document.getElementById('phoneModif');
	if(verfTel(tel.value)){
		tel.setCustomValidity('');
	}else{
		tel.setCustomValidity('phone invalide!(test)');
	}
	var email = [document.getElementById('email1Modif'),document.getElementById('email2Modif')];
	for (var i = 0; i <2; i++) {
		if(verfMail(email[i].value)){
			if (email[0].value==email[1].value) {
				email[1].setCustomValidity('');
			}else{
				email[1].setCustomValidity('pas les meme mails');
			}
		}else{
			email[i].setCustomValidity('email invalide');
		}
	}
	return(true);
}