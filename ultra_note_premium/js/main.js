
function clear(){
    var d=document.getElementById("div_main");
    // nettoyage
    for(c of d.children){
        d.removeChild(c);
    }
    d.children=[];
    d.innerHTML="";
}

function change_page(page, bt_actif=null){
    var d=document.getElementById("div_main");
    clear();
    $( "#div_main" ).load( "includes/pages/"+page+".php", function( response, status, xhr ) {
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
