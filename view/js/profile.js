var parametre = ["name","firstName","birth","email","address","phone","password","validate"];
for (var i = parametre.length - 1; i >= 0; i--) {
	console.log("création du bouton : " + parametre[i]);
	button(parametre[i]);
}

function display(id){
	id = id + "Modif"
	var doc = document.getElementById(id);
	if (doc.style.display == "block"){
		doc.style.display = ""
	}else{
		doc.style.display = "block"	
	}
	console.log("moddifiquation du display de : " + id);
}
function button(element){
	id = element;
	buttonName = element + "Button";
	var btn = document.getElementById(buttonName);
	btn.onclick = function(){display(id);};
	console.log("bouton "+element +" crée");
}