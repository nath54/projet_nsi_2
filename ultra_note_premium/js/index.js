

function to_connect(){
    document.getElementById("divinscription").style.display = "none";
    document.getElementById("divinfo").style.display = "none";
    document.getElementById("divconnect").style.display = "initial";
}

function to_inscription(){
    document.getElementById("divconnect").style.display = "none";
    document.getElementById("divinfo").style.display = "none";
    document.getElementById("divinscription").style.display = "initial";
}


function to_info(){
    document.getElementById("divconnect").style.display = "none";
    document.getElementById("divinscription").style.display = "none";
    document.getElementById("divinfo").style.display = "initial";
}

function to_accueil(){
    document.getElementById("divconnect").style.display = "none";
    document.getElementById("divinscription").style.display = "none";
    document.getElementById("divinfo").style.display = "none";
}



function update_inscription(){
    var tp = document.getElementById("stype").value;
    if(tp=="un élève"){
        document.getElementById("ieleve").style.display = "initial";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="un professeur"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "initial";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="un administrateur"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("iadmin").style.display = "initial";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="un parent"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "initial";
    }
}

function add_mat(){
    var c = document.createElement("select")
    c.setAttribute("class", "smat");
    for(mat of matieres){
        var m = document.createElement("option");
        m.innerHTML = mat;
        c.appendChild(m);
    }
    document.getElementById("smats").appendChild(c);
}


function rem_mat(){
    var smats = document.getElementById("smats");
    if(smats.children.length >= 1){
        var c = smats.children[smats.children.length - 1];
        smats.removeChild(c);
    }
}

