function clear() {
    var d = document.getElementById("div_main");
    // nettoyage
    for (c of d.children) {
        d.removeChild(c);
    }
    d.children = [];
    d.innerHTML = "";
}

function delete_account(id_ac, txt_en_plus = "") {
    var c = confirm("Etes vous sur de vouloir supprimer ce compte " + txt_en_plus + "?");
    if (c) {
        $("#div_main").load("includes/utils/delete_account.php?id_account=" + id_ac, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Sorry but there was an error: ";
                alert(msg + xhr.status + " " + xhr.statusText);
            }
        });
    }
}

function modify_account(id_ac, txt_en_plus = "") {
    $("#div_main").load("includes/pages/modify_account.php?id_account=" + id_ac, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            alert(msg + xhr.status + " " + xhr.statusText);
        }
    });
}

function change_page(page, bt_actif = null, arguments = "") {
    if (page == null) {
        alert(sessionStorage["tp_compte"]);
        page = "accueil_" + sessionStorage["tp_compte"]
    }
    //alert("Change page vers "+page);
    sessionStorage["bt_actif"] = bt_actif;
    sessionStorage["actual_page"] = page;
    var d = document.getElementById("div_main");
    clear();
    var requete = "includes/pages/" + page + ".php?" + arguments;
    // alert(requete);
    $("#div_main").load(requete, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            alert(msg + xhr.status + " " + xhr.statusText);
        }
    });
    //
    for (b of document.getElementById("header_right").children) {
        if (b.nodeName == "BUTTON") {
            b.setAttribute("class", "bt_header");
            b.disabled = false;
        }
    }
    //
    if (bt_actif != null) {
        var b = document.getElementById(bt_actif);
        if (b != undefined) {
            b.setAttribute("class", "bt_header_active");
            // b.disabled = true;
        }
    }
}

function update() {
    if (sessionStorage.getItem("actual_page") == null) {
        change_page("accueil_" + sessionStorage["tp_compte"]);
    } else {
        change_page(sessionStorage["actual_page"], sessionStorage.getItem("bt_actif"));
    }
}

function on_load() {
    //
    var page = null;
    //
    var parameters = location.search.substring(1).split("&");
    for (p of parameters) {
        var pp = p.split("=");
        if (pp[0] == "page") {
            page = pp[1];
        }
    }
    //
    if (page != null) {
        change_page(page);
    }
}

// Fonction qui vérifie si une chaine de characteres donné peut-être transformé en int/float ou pas
function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!  
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
        !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

// Fonction qui teste si une chaine de charactere donnée est de format date valide
function isDateValid(date) {
    return (new Date(date) !== "Invalid Date") && !isNaN(new Date(date));
}

// Returns the ISO week of the date.
Date.prototype.getWeek = function() {
    var date = new Date(this.getTime());
    date.setHours(0, 0, 0, 0);
    // Thursday in current week decides the year.
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
    // January 4 is always in week 1.
    var week1 = new Date(date.getFullYear(), 0, 4);
    // Adjust to Thursday in week 1 and count number of weeks from date to week1.
    return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 -
        3 + (week1.getDay() + 6) % 7) / 7);
}

Date.prototype.addDays = function(days) {
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
}