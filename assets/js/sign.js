let con = document.getElementById('Sign_in');
let ins = document.getElementById('Sign_up');
let swi = document.getElementById('box');
let var_alt = 0;


if(state == 'connexion') {
    var_alt = 0;
    alt();
} else if(state == 'inscription') {
    var_alt = 1;
    alt();
} else {
    //window.location.href = "/assets/template/errors/404.php";
    var_alt = 0;
    alt();
}

function alt(){
    console.log(var_alt);
    if(var_alt == 1){
        ins.style.display = "block";
        con.style.display = "none";
        swi.style.left = "auto";
        swi.style.right = "0";
        var_alt = 0;
        return;
    }
    con.style.display = "block";
    ins.style.display = "none";
    swi.style.left = "0";
    swi.style.right = "auto";
    var_alt = 1;
    return;
}