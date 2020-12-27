
var characteres_autorises = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", 
    "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1",
    "2", "3", "4", "5", "6", "7", "8", "9", "_", "&", "*"
]


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
        o.setAttribute("name", "imatiere_"+kid);
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
        o.setAttribute("name", "ienfant_"+kid);
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
        o.setAttribute("name", "igroupe_"+kid);
        c.appendChild(o);
    }
    document.getElementById("sgrps").appendChild(c);
}


function before_submit(){
    var good=true;
    var p = document.getElementById("ipseudo").value;
    var ps1 = document.getElementById("ipassword").value;
    var ps2 = document.getElementById("ipassword2").value;
    // pseudo test
    if(p.length<6){
        alert("Le pseudo doit faire au moins 6 characteres");
        return
    }
    if(p.length>18){
        alert("Le pseudo doit faire au plus 18 characteres");
        return
    }
    for(c of p){
        if(!characteres_autorises.includes(c)){
            alert("Charactère non autorisé dans le pseudo ! Veuillez n'utiliser que des lettres (majuscules ou minuscules) et des chiffres sans accents !");
            return
        }
    }
    // password test
    if(ps1 != ps2){
        alert("Les mots de passes sont différents !");
        return
    }
    if(ps1.length<8){
        alert("Le mot de passe doit faire au moins 8 characteres");
        return
    }
    if(ps1.length>18){
        alert("Le mot de passe doit faire au plus 18 characteres");
        return
    }
    for(c of ps1){
        if(!characteres_autorises.includes(c)){
            alert("Charactère non autorisé dans le mot de passe ! Veuillez n'utiliser que des lettres (majuscules ou minuscules) et des chiffres sans accents !");
            return
        }
    }
    // Test du prénom et du nom
    var pn = document.getElementById("iprenom").value;
    var n = document.getElementById("inom").value;
    if(pn.length < 2){
        alert("Le prénom doit faire au moin 2 characteres");
        return
    }
    if(pn.length > 18){
        alert("Le prénom doit faire au plus 18 characteres");
        return
    }
    for(c of pn){
        if(!characteres_autorises.includes(c)){
            alert("Un charactere n'est pas autorisé dans le prénom !")
            return
        }
    }
    //
    if(n.length < 2){
        alert("Le nom doit faire au moin 2 characteres");
        return
    }
    if(n.length > 18){
        alert("Le nom doit faire au plus 18 characteres");
        return
    }
    for(c of n){
        if(!characteres_autorises.includes(c)){
            alert("Un charactere n'est pas autorisé dans le nom !")
            return
        }
    }
    // on submit si c'est bon
    document.getElementById("finscription").submit();
}


