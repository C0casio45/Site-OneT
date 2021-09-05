let nbAccuse = 0;

function display(){
    param = document.getElementById("type").selectedIndex;
    switch (param) {
        case 0:
            document.getElementById("container_acc").style.display= "block";
            document.getElementById("url_faceit_game_l").style.display= "block";
            document.getElementById("url_faceit_game").style.display= "block";
            break;
        case 1:
            document.getElementById("container_acc").style.display= "none";
            document.getElementById("url_faceit_game_l").style.display= "none";
            document.getElementById("url_faceit_game").style.display= "none";

            break;
        case 2:
            document.getElementById("container_acc").style.display= "none";
            document.getElementById("url_faceit_game_l").style.display= "none";
            document.getElementById("url_faceit_game").style.display= "none";

            break;

        default:
            break;
    }
}

function addAccuse(){
    nbAccuse++;
    let container = document.getElementById("container_acc");
    container.innerHTML += `
    <div class="accuse" id="`+ nbAccuse +`">
        <input class="acc" type="text" name="url_faceit_acc[`+ nbAccuse +`]"/>
        <a href="javascript:void(0);" class="remove" onclick="removeAccuse(this)">-</a>
    </div>
    `
}

function removeAccuse(e){
    let id = e.parentNode.id;
    let box = document.getElementById(id);
    box.remove();
    if(id < nbAccuse){
        for(let i = nbAccuse;id < i;i--){
            document.getElementById(i).firstElementChild.setAttribute("name", "url_faceit_acc_"+ (i-1));
            document.getElementById(i).id = i-1;
        }
    }
    nbAccuse--;
    
}