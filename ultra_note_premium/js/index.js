

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
    if(tp=="eleve"){
        document.getElementById("ieleve").style.display = "initial";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("ielprof").style.display = "initial";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="prof"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "initial";
        document.getElementById("ielprof").style.display = "initial";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="admin"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("ielprof").style.display = "none";
        document.getElementById("iadmin").style.display = "initial";
        document.getElementById("iparent").style.display = "none";
    }
    else if(tp=="parent"){
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("ielprof").style.display = "none";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "initial";
    }
}


//


function rem(id_){
    var sel = document.getElementById(id_);
    if(sel.children.length >= 1){
        var c = sel.children[sel.children.length - 1];
        sel.removeChild(c);
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

function add_enf(){
    var c = document.createElement("select")
    c.setAttribute("class", "senf");
    for(kid of Object.keys(eleves)){
        var o = document.createElement("option");
        o.innerHTML = eleves[kid];
        o.setAttribute("value", kid);
        c.appendChild(o);
    }
    document.getElementById("senfs").appendChild(c);
}

function add_grp(){
    var c = document.createElement("select")
    c.setAttribute("class", "sgrp");
    for(kid of Object.keys(grpclasses)){
        var o = document.createElement("option");
        o.innerHTML = grpclasses[kid];
        o.setAttribute("value", kid);
        c.appendChild(o);
    }
    document.getElementById("sgrps").appendChild(c);
}


function before_submit(){
    var mats=[];
    for(c of document.getElementsByClassName("smat")){
        mats.push(c.value);
    }
    //
    var enfs=[];
    for(c of document.getElementsByClassName("senf")){
        enfs.push(c.value);
    }
    //
    var grps=[];
    for(c of document.getElementsByClassName("sgpr")){
        gprs.push(c.value);
    }
    //
    document.getElementById("ienfants").value = enfs.join("|");
    document.getElementById("igroupes").value = gprs.join("|");
    document.getElementById("imatieres").value = mats.join("|");
}


