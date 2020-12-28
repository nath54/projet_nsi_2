
function clear(){
    var d=document.getElementById("div_main");
    // nettoyage
    for(c of d.children){
        d.removeChild(c);
    }
    d.children=[];
    d.innerHTML="";
}

function change_page(page, bt_actif=null, arguments=""){
    sessionStorage["bt_actif"]=bt_actif;
    sessionStorage["actual_page"]=page;
    var d=document.getElementById("div_main");
    clear();
    $( "#div_main" ).load( "includes/pages/"+page+".php?"+arguments, function( response, status, xhr ) {
        if ( status == "error" ) {
          var msg = "Sorry but there was an error: ";
          alert( msg + xhr.status + " " + xhr.statusText );
        }
    });
    //
    for(b of document.getElementById("header_right").children){
        if(b.nodeName=="BUTTON"){
            b.setAttribute("class", "bt_header");
            b.disabled = false;
        }
    }
    //
    if(bt_actif!=null){
        var b = document.getElementById(bt_actif);
        b.setAttribute("class", "bt_header_active");
        b.disabled = true;
    }
}

function delete_account(id_ac, txt_en_plus=""){
    var c = confirm("Etes vous sur de vouloir supprimer ce compte "+txt_en_plus+"?");
    if(c){
        $( "#div_main" ).load( "includes/utils/delete_account.php?id_account="+id_ac, function( response, status, xhr ) {
            if ( status == "error" ) {
              var msg = "Sorry but there was an error: ";
              alert( msg + xhr.status + " " + xhr.statusText );
            }
        });
    }
}

function update(){
    if(sessionStorage.getItem("actual_page")==null){
        change_page("accueil_"+sessionStorage["tp_compte"]);
    }
    else{
        change_page(sessionStorage["actual_page"], sessionStorage.getItem("bt_actif"));
    }
}

function create_account(){

}

