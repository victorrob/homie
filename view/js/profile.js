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
	if (id =="password"){
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