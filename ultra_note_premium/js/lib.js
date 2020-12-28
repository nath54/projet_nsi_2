

function toggle_password(pid){
    var d=document.getElementById("pid");
    if(!d){
        return
    }
    if(d.getAttribute("type")=="password"){
        d.setAttribute("type", "text");
    }
    else{
        d.setAttribute("type", "password");
    }
}

