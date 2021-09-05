//Inutile de modifier cela, la vérification se fait dans le php. Ceci aide simplement a l'utilisation
//
//Sale fou va

document.addEventListener('keyup', logKey);

function logKey(e) {
    let mdp = document.getElementById("inpassword");
    let conf_mdp = document.getElementById("conf_mdp");
    if(mdp.value == conf_mdp.value){
        var inputs = document.getElementsByTagName('input');
        mdp.style.border = "1px solid green"
        conf_mdp.style.border = "1px solid green"

        for(var i = 0; i < inputs.length; i++) {
            if(inputs[i].type.toLowerCase() == 'submit') {
                inputs[i].removeAttribute("disabled");
            }
        }
    } else{
        var inputs = document.getElementById('inscrip');
        inputs.setAttribute("disabled", "");
        mdp.style.border = "1px solid red"
        conf_mdp.style.border = "1px solid red"

    }
}
