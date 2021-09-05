httpRequestA = new XMLHttpRequest();
httpRequestB = new XMLHttpRequest();
httpRequestC = new XMLHttpRequest();

if (!httpRequestA) {
    alert('Abandon :( Impossible de créer une instance de XMLHTTP');
}

main(httpRequestA,"new");
main(httpRequestB,"my");
main(httpRequestC,"current");

function main(httpRequest,Type){
    switch(Type){
        case "new":
            httpRequest.onreadystatechange = function(){loadTicket(httpRequest,Type);};
            httpRequest.open('POST', 'assets/php/ticket_new.php');
            break;
        case "my":
            httpRequest.onreadystatechange = function(){loadTicket(httpRequest,Type);};
            httpRequest.open('POST', 'assets/php/ticket_my.php');
            break;
        case "current":
            httpRequest.onreadystatechange = function(){loadTicket(httpRequest,Type);};
            httpRequest.open('POST', 'assets/php/ticket_current.php');
            break;
        default :
            alert('Touche pas a mes variables sale fou');
            break;
    }
    httpRequest.send();
}

function loadTicket(httpRequest,id) {
    
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
                switch(id){
                    case "new":
                        affTicketNew(element,id);
                        break;
                    default :
                        affTicket(element,id);
                        break;
                }
                
            });
            return;
        } else {
            document.getElementById(id).innerHTML += "<article>Il n'y a pas de nouveaux tickets.</article>";
            return
        }
    } else {
        console.log("Erreur de httpRequest, essayez de mettre a jour votre navigateur ou d'en changer.");
    }
}

function affTicketNew(rst,id){
    document.getElementById(id).innerHTML += `
    <div class="ticket" idt="`+rst.idTicket+`">
        <div>
        <p>Créé par : `+rst.username+`</p>
        <p>Créé le : `+timeTranslator(rst.Ouverture)+`</p>
        <p>Type : `+rst.Type+`</p>
        </div>
        <a class="take" href="assets/php/ticket_take.php?id=`+rst.idTicket+`">Prendre le ticket</a>
        <div>
            <span class="down" onclick="affMore(this,'u');">˅</span>
            <span onclick="affMore(this,'d');">˄</span>
        </div>
        <div class="more">
            <p>Lien de la Game : <a href="`+rst.FaceitGame+`" target="_blank">`+rst.FaceitGame+`</a></p>
            `+cutPeople(rst.Accuse,rst.LienAccuse)+`</p></br>
            <p>Message :</p>
            <p>`+rst.content+`</p>
        </div>
    </div>`;
}

function affTicket(rst,id){
    document.getElementById(id).innerHTML += `
    <div class="ticket" idt="`+rst.idTicket+`">
        <div>
        <p>Créé par : `+rst.username+`</p>
        <p>Créé le : `+timeTranslator(rst.Ouverture)+`</p>
        <p>Type : `+rst.Type+`</p>
        <p>Administré par : `+rst.Admin+`</p>
        </div>
        <a class="take" href="ticket_page.php?id=`+rst.idTicket+`" target="_blank">Voir</a>
        <div>
            <span class="down" onclick="affMore(this,'u');">˅</span>
            <span onclick="affMore(this,'d');">˄</span>
        </div>
        <div class="more">
            <p>Lien de la Game : <a href="`+rst.FaceitGame+`" target="_blank">`+rst.FaceitGame+`</a></p>
            `+cutPeople(rst.Accuse,rst.LienAccuse)+`</p></br>
            <p>Message :</p>
            <p>`+rst.content+`</p>
        </div>
    </div>`;
}



function timeTranslator(time){
    var dateStr=time;
    var a=dateStr.split(" ");
    var d=a[0].split("-");
    var t=a[1].split(":");
    return d[0]+'/'+(d[1]-1)+'/'+d[2]+' à '+ t[0]+':'+t[1]+':'+t[2]
}

function cutPeople(strPseudo, strLink){
    let arrPseudo = strPseudo.split(",");
    let len = arrPseudo.length
    let arrLink = strLink.split(",");
    let arr = "";
    if(len > 1){
        st = "<p>Pseudo des joueur : "
    } else {
        st = "<p>Pseudo du joueur : "
    }
    for(let i = 0; i < len; i++){
        arr += `<a href="`+arrLink[i]+`" target="_blank">`+arrPseudo[i]+`</a> `;
    }
    return st + arr;
}


function affMore(e,v){
    let thidm = e.parentNode.parentNode;
    let thid = e.parentNode;
    switch (v) {
        case "u":
            thid.lastElementChild.style.display="block";
            thid.firstElementChild.style.display="none";
            thidm.lastElementChild.style.display="none";
            break;
        case "d":
            thid.lastElementChild.style.display="none";
            thid.firstElementChild.style.display="block";
            thidm.lastElementChild.style.display="block"; 
            break;
        default:
            break;
    }
}