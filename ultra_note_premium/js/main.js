
function clear(){
    var d=document.getElementById("div_main");
    // nettoyage
    for(c of d.children){
        d.removeChild(c);
    }
    d.children=[];
    d.innerHTML="";
}

function change_page(page){
    var d=document.getElementById("div_main");
    clear();
    d.innerHTML="<?php include 'includes/"+page+".php'; ?>";
}
