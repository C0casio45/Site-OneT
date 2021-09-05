httpRequest = new XMLHttpRequest();

if (!httpRequest) {
    alert('Abandon :( Impossible de créer une instance de XMLHTTP');
}

httpRequest.onreadystatechange = loadTicketMy;
httpRequest.open('POST', 'assets/php/ticket_my.php');
httpRequest.send();

function loadTicketMy() {
    
    if (httpRequest.readyState == 0){
        console.log("Envoie en cours");
    } else if (httpRequest.readyState == 1) {
        console.log("En attente du serveur");
    } else if (httpRequest.readyState == 2){
        console.log("Réception des premiers éléments");
    } else if (httpRequest.readyState == 3){
        console.log("Chargement en cours");
    } else if (httpRequest.readyState == 4) {
        if (httpRequest.status === 200) {
            let resultat = JSON.parse(httpRequest.responseText);
            resultat.forEach(element => {
                affTicketMy(element,"my");
            });
            return;
        } else {
            document.getElementById("my").innerHTML += "<article>Vous n'avez pas de tickets !</article>";
            return
        }
    } else {
        console.log("Erreur de httpRequest, essayez de mettre a jour votre navigateur ou d'en changer.");
    }
}

function affTicketMy(rst,id){
    document.getElementById(id).innerHTML += `
    <div class="ticket" id="`+rst.idTicket+`">
        <div>
        <p>Créé par : `+rst.username+`</p>
        <p>Créé le : `+timeTranslator(rst.Ouverture)+`</p>
        <p>Type : `+rst.Type+`</p>
        </div>
        <a class="take" href="ticket_page.php?id=`+rst.idTicket+`" target="_blank">Voir</a>
        <span id="down" onclick="affMore(this,'u');">˅</span>
        <span id="up" onclick="affMore(this,'d');">˄</span>
        <div class="more">
            <p>Lien de la Game : <a href="`+rst.FaceitGame+`" target="_blank">`+rst.FaceitGame+`</a></p>
            <p>Pseudo du joueur : <a href="`+rst.LienFaceit+`" target="_blank">`+rst.Pseudo+`</a></p></br>
            <p>Message :</p>
            <p>`+rst.content+`</p>
        </div>
    </div>`;
}


function affMore(e,v){
    let thid = e.parentNode;
    switch (v) {
        case "u":
            document.getElementById("up").style.display="block";
            document.getElementById("down").style.display="none";
            thid.lastElementChild.style.display="none";
            break;
        case "d":
            document.getElementById("up").style.display="none";
            document.getElementById("down").style.display="block";
            thid.lastElementChild.style.display="block"; 
            break;
        default:
            break;
    }
}




function timeTranslator(time){
    var dateStr=time;
    var a=dateStr.split(" ");
    var d=a[0].split("-");
    var t=a[1].split(":");
    return d[0]+'/'+(d[1]-1)+'/'+d[2]+' à '+ t[0]+':'+t[1]+':'+t[2]
}