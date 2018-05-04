function display(id){
    if (id =="password"){
        display(id+"1");
        display(id+"2");
    }else{
        var id = id + "Modif";
        var doc = document.getElementById(id);
        if (doc.style.display == "block"){
            doc.style.display = "";
        }else{
            doc.style.display = "block";
        }
        console.log("moddifiquation du display de : " + id);
    }