// Liste des caracteres autorisés dans les nom/prénom/pseudos/password
var characteres_autorises = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r",
    "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1",
    "2", "3", "4", "5", "6", "7", "8", "9", "-", "_", "&", "*", "é", "à", "è", "ç", "ù", "ï"
];


/*
Fonction qui vérifie le formulaire avant de l'envoyer au php
*/
function before_submit(id_f = "finscription") {
    var ps1 = document.getElementById("ipassword").value;
    var ps2 = document.getElementById("ipassword2").value;
    var ps = document.getElementById("ipassword").placeholder;
    var fs = {
            "inom": { "nom": "nom", "min": 2, "max": 18 },
            "iprenom": { "nom": "prénom", "min": 2, "max": 18 },
            "ipseudo": { "nom": "pseudo", "min": 6, "max": 18 }
        }
        // Pour éviter de bloquer quand on ne veut pas modifier le mot de passe quand on veut modifier les infos d'un compte
    if (ps != "Keep Empty to Keep") {
        fs["ipassword"] = { "nom": "mot de passe", "min": 8, "max": 18 };
    }
    //
    for (f of Object.keys(fs)) {
        var d = fs[f];
        var e = document.getElementById(f);
        if (e) {
            var t = e.value;
            if (t.length < d["min"]) {
                alert("Le " + d["nom"] + " doit contenir au moins " + d["min"] + " characteres !");
                return
            }
            if (t.length > d["max"]) {
                alert("Le " + d["nom"] + " doit contenir au plus " + d["mac"] + " characteres !");
                return
            }
            for (c of t) {
                if (!characteres_autorises.includes(c)) {
                    alert("Un charactere n'est pas autorisé dans le " + d["nom"] + " !");
                    return
                }
            }
        }
    }
    // password test
    if (ps1 != ps2) {
        alert("Les mots de passes sont différents !");
        return
    }
    //
    var tp = document.getElementById("stype").value;
    if (tp == "prof") {
        var mats = [];
        for (el of document.getElementsByClassName("smat")) {
            if (!mats.includes(el.value)) { mats.push(el.value) };
        }
        document.getElementById("prof_matieres").value = mats.join("|");
        var grps = [];
        for (el of document.getElementsByClassName("sgrp")) {
            if (!grps.includes(el.value)) { grps.push(el.value) };
        }
        document.getElementById("prof_groupes").value = grps.join("|");
    }
    if (tp == "parent") {
        var enfs = [];
        for (el of document.getElementsByClassName("senf")) {
            if (!enfs.includes(el.value)) { enfs.push(el.value) };
        }
        document.getElementById("parent_enfants").value = enfs.join("|");
    }
    // on submit si c'est bon
    document.getElementById(id_f).submit();
}


/*
Fonction qui va mettre a jour l'apparence du formulaire
(cacher les <div> qui ne sont pas adaptées)
ex: si le type devient élève, on va cacher les infos liées au profs, aux admin et aux parents
*/
function update_inscription() {
    var tp = document.getElementById("stype").value;
    if (tp == "eleve") {
        document.getElementById("ieleve").style.display = "initial";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("ielprof").style.display = "initial";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    } else if (tp == "prof") {
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "initial";
        document.getElementById("ielprof").style.display = "initial";
        document.getElementById("iadmin").style.display = "none";
        document.getElementById("iparent").style.display = "none";
    } else if (tp == "admin") {
        document.getElementById("ieleve").style.display = "none";
        document.getElementById("iprof").style.display = "none";
        document.getElementById("ielprof").style.display = "none";
        document.getElementById("iadmin").style.display = "initial";
        document.getElementById("iparent").style.display = "none";
    } else if (tp == "parent") {
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
function rem(id_) {
    var sel = document.getElementById(id_);
    if (sel.children.length >= 1) {
        var c = sel.children[sel.children.length - 1];
        sel.removeChild(c);
    }
}

/*
Fonction qui va rajouter un champs de sélection d'une matière
dans la liste des matières qu'un prof enseigne
*/
function add_mat(value = null) {
    var c = document.createElement("select")
    c.setAttribute("class", "smat");
    for (mat of Object.keys(matieres)) {
        var m = document.createElement("option");
        m.innerHTML = mat;
        m.setAttribute("name", "imatiere_" + mat);
        m.setAttribute("value", matieres[mat]);
        c.appendChild(m);
    }
    if (value != null) {
        c.value = value;
    }
    document.getElementById("smats").appendChild(c);
}

/*
Fonction qui va rajouter un champs de sélection d'un enfant
dans la liste des enfants qu'un parent a
*/
function add_enf(value = null) {
    var c = document.createElement("select")
    c.setAttribute("class", "senf");
    for (kid of Object.keys(eleves)) {
        var o = document.createElement("option");
        o.innerHTML = eleves[kid];
        o.setAttribute("value", kid);
        o.setAttribute("name", "ienfant_" + kid);
        c.appendChild(o);
    }
    if (value != null) {
        c.value = value;
    }
    document.getElementById("senfs").appendChild(c);
}

/*
Fonction qui va rajouter un champs de sélection d'un groupe d'élève
dans la liste des groupes qu'un prof doit prendre en charge
*/
function add_grp(value = null) {
    var c = document.createElement("select")
    c.setAttribute("class", "sgrp");
    for (kid of Object.keys(grpclasses)) {
        var o = document.createElement("option");
        o.innerHTML = grpclasses[kid];
        o.setAttribute("value", kid);
        o.setAttribute("name", "igroupe_" + kid);
        c.appendChild(o);
    }
    if (value != null) {
        c.value = value;
    }
    document.getElementById("sgrps").appendChild(c);
}




function gen_el() {
    var modeles = ["cvcv", "cvcvc", "cvccvc", "vcvcv", "cvv", "cvcvcv"];
    var lfs = { "a": 71, "b": 11, "c": 32, "d": 37, "e": 121, "f": 11, "g": 12, "h": 11, "i": 66, "j": 3, "k": 3, "l": 50, "m": 26, "n": 64, "o": 50, "p": 25, "q": 7, "r": 60, "s": 65, "t": 59, "u": 45, "v": 11, "w": 2, "x": 4, "y": 5, "z": 2 };
    var voys = [];
    var cons = [];
    for (l of["a", "e", "y", "u", "i", "o"]) {
        for (x = 0; x < lfs[l]; x++) { voys.push(l); }
    }
    for (l of["z", "r", "t", "p", "q", "s", "d", "f", "g", "h", "j", "k", "l", "m", "w", "x", "c", "v", "b", "n"]) {
        for (x = 0; x < lfs[l]; x++) { cons.push(l); }
    }
    var iprenom = document.getElementById("iprenom");
    var prenom = prenoms[parseInt(Math.random() * prenoms.length)];
    iprenom.value = prenom;
    var inom = document.getElementById("inom");
    var nom = "";
    for (l of modeles[parseInt(Math.random() * modeles.length)]) {
        var a = "";
        if (l == "c") { a = cons[parseInt(Math.random() * cons.length)]; } else { a = voys[parseInt(Math.random() * voys.length)]; }
        if (nom == "") { a = a.toUpperCase(); }
        nom += a;
    }
    inom.value = nom;
    var ipseudo = document.getElementById("ipseudo");
    var pseudo = nom.toLowerCase() + prenom.toLowerCase();
    ipseudo.value = pseudo;
    var ips1 = document.getElementById("ipassword");
    var ips2 = document.getElementById("ipassword2");
    var password = pseudo;
    // for(x=0; x<12; x++){
    //     password+=characteres_autorises[parseInt(Math.random()*characteres_autorises.length)];
    // }
    ips1.value = password;
    ips2.value = password;
    var ij = document.getElementById("ijour");
    ij.value = 1 + parseInt(Math.random() * 29);
    var im = document.getElementById("imois");
    im.value = 1 + parseInt(Math.random() * 11);
    var ia = document.getElementById("ian");
    ia.value = 1995 + parseInt(Math.random() * 10);
    //
}