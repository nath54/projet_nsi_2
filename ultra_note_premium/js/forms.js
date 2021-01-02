
// Liste des caracteres autorisés dans les nom/prénom/pseudos/password
var characteres_autorises = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r",
    "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1",
    "2", "3", "4", "5", "6", "7", "8", "9", "_", "&", "*", "é", "à", "è", "ç", "ù", "ï"
];


/*
Fonction qui vérifie le formulaire avant de l'envoyer au php
*/
function before_submit(id_f="finscription"){
    var ps1=document.getElementById("ipassword").value;
    var ps2=document.getElementById("ipassword2").value;
    var ps=document.getElementById("ipassword").placeholder;
    var fs = {
        "inom": {"nom":"nom", "min": 2, "max": 18},
        "iprenom": {"nom":"prénom", "min": 2, "max": 18},
        "ipseudo": {"nom":"pseudo", "min": 6, "max": 18}
    }
    // Pour éviter de bloquer quand on ne veut pas modifier le mot de passe quand on veut modifier les infos d'un compte
    if(ps!="Keep Empty to Keep"){
        fs["ipassword"]={"nom":"mot de passe", "min": 8, "max": 18};
    }
    //
    for(f of Object.keys(fs)){
        var d = fs[f];
        var e = document.getElementById(f);
        if(e){
            var t = e.value;
            if(t.length<d["min"]){
                alert("Le "+d["nom"]+" doit contenir au moins "+d["min"]+" characteres !");
                return
            }
            if(t.length>d["max"]){
                alert("Le "+d["nom"]+" doit contenir au plus "+d["mac"]+" characteres !");
                return
            }
            for(c of t){
                if(!characteres_autorises.includes(c)){
                    alert("Un charactere n'est pas autorisé dans le "+d["nom"]+" !");
                    return
                }
            }
        }
    }
    // password test
    if(ps1 != ps2){
        alert("Les mots de passes sont différents !");
        return
    }
    // on submit si c'est bon
    document.getElementById(id_f).submit();
}


/*
Fonction qui va mettre a jour l'apparence du formulaire
(cacher les <div> qui ne sont pas adaptées)
ex: si le type devient élève, on va cacher les infos liées au profs, aux admin et aux parents
*/
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

/*
Fonction qui va enlever le dernier élément d'un autre élément html
Est utilisé dans le cas de l'inscription, pour les profs/parents
Ex: Quand le prof s'est trompé dans les matières dans lesquels il enseigne,
il va l'enlever dans la liste des matieres qu'il enseigne
*/
function rem(id_){
    var sel = document.getElementById(id_);
    if(sel.children.length >= 1){
        var c = sel.children[sel.children.length - 1];
        sel.removeChild(c);
    }
}

/*
Fonction qui va rajouter un champs de sélection d'une matière
dans la liste des matières qu'un prof enseigne
*/
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

/*
Fonction qui va rajouter un champs de sélection d'un enfant
dans la liste des enfants qu'un parent a
*/
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

/*
Fonction qui va rajouter un champs de sélection d'un groupe d'élève
dans la liste des groupes qu'un prof doit prendre en charge
*/
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

