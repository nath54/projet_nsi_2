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
            b.disabled = true;
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