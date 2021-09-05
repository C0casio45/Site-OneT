httpRequestA = new XMLHttpRequest();
httpRequestB = new XMLHttpRequest();
httpRequestC = new XMLHttpRequest();
httpRequestD = new XMLHttpRequest();
let i;

if (!httpRequestA) {
    alert('Abandon :( Impossible de créer une instance de XMLHTTP');
}

httpRequestA.onreadystatechange = loadTicketNew;
httpRequestA.open('POST', 'assets/php/ticket_new.php');
httpRequestA.send();

function loadTicketNew() {
    
    if (httpRequestA.readyState == 0){
        console.log("Envoie en cours");
    } else if (httpRequestA.readyState == 1) {
        console.log("En attente du serveur");
    } else if (httpRequestA.readyState == 2){
        console.log("Réception des premiers éléments");
    } else if (httpRequestA.readyState == 3){
        console.log("Chargement en cours");
    } else if (httpRequestA.readyState == 4) {
        if (httpRequestA.status === 200) {
            let resultat = JSON.parse(httpRequestA.responseText);
            resultat.forEach(element => {
                affTicketNew(element,"new");
            });
            return;
        } else {
            document.getElementById("new").innerHTML += "<article>Il n'y a pas de nouveaux tickets.</article>";
            return
        }
    } else {
        console.log("Erreur de httpRequest, essayez de mettre a jour votre navigateur ou d'en changer.");
    }
}

function affTicketNew(rst,id){
    document.getElementById(id).innerHTML += `
    <div class="ticket" id="`+rst.idTicket+`">
        <div>
        <p>Créé par : `+rst.username+`</p>
        <p>Créé le : `+timeTranslator(rst.Ouverture)+`</p>
        <p>Type : `+rst.Type+`</p>
        </div>
        <a class="take" href="assets/php/ticket_take.php?id=`+rst.idTicket+`">Prendre le ticket</a>
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



httpRequestB.onreadystatechange = loadTicketMy;
httpRequestB.open('POST', 'assets/php/ticket_my.php');
httpRequestB.send();

function loadTicketMy() {
    
    if (httpRequestB.readyState == 0){
        console.log("Envoie en cours");
    } else if (httpRequestB.readyState == 1) {
        console.log("En attente du serveur");
    } else if (httpRequestB.readyState == 2){
        console.log("Réception des premiers éléments");
    } else if (httpRequestB.readyState == 3){
        console.log("Chargement en cours");
    } else if (httpRequestB.readyState == 4) {
        if (httpRequestB.status === 200) {
            let resultat = JSON.parse(httpRequestB.responseText);
            resultat.forEach(element => {
                affTicketMy(element,"my");
            });
            return;
        } else {
            document.getElementById("my").innerHTML += "<article>Il n'y a pas de nouveaux tickets.</article>";
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



httpRequestC.onreadystatechange = loadTicketCurr;
httpRequestC.open('POST', 'assets/php/ticket_current.php');
httpRequestC.send();

function loadTicketCurr() {
    
    if (httpRequestC.readyState == 0){
        console.log("Envoie en cours");
    } else if (httpRequestC.readyState == 1) {
        console.log("En attente du serveur");
    } else if (httpRequestC.readyState == 2){
        console.log("Réception des premiers éléments");
    } else if (httpRequestC.readyState == 3){
        console.log("Chargement en cours");
    } else if (httpRequestC.readyState == 4) {
        if (httpRequestC.status === 200) {
            let resultat = JSON.parse(httpRequestC.responseText);
            resultat.forEach(element => {
                affTicketCurr(element,"current");
            });
            return;
        } else {
            document.getElementById("current").innerHTML += "<article>Il n'y a pas de tickets en cour.</article>";
            return
        }
    } else {
        console.log("Erreur de httpRequest, essayez de mettre a jour votre navigateur ou d'en changer.");
    }
}

function affTicketCurr(rst,id){
    document.getElementById(id).innerHTML += `
    <div class="ticket" id="`+rst.idTicket+`">
        <div>
        <p>Créé par : `+rst.username+`</p>
        <p>Créé le : `+timeTranslator(rst.Ouverture)+`</p>
        <p>Type : `+rst.Type+`</p>
        <p>Modéré par : `+rst.Admin+`</p>
        </div>
        <a class="take" href="ticket_page.php?id=`+rst.idTicket+`" target="_blank">Voir</a>
        <span id="down" onclick="affMore(this,'u');">˅</span>
        <span id="up" onclick="affMore(this,'d');">˄</span>
        <div class="more">
            <p>Lien de la Game : <a href="`+rst.FaceitGame+`" target="_blank">`+rst.FaceitGame+`</a></p>
            <p>Pseudo du / des joueur : `+cutPeople()+`
            <p>Message :</p>
            <p>`+rst.content+`</p>
        </div>
    </div>`;
}




httpRequestD.onreadystatechange = loadTicketAll;
httpRequestD.open('POST', 'assets/php/ticket_all.php');
httpRequestD.send();

function loadTicketAll() {
    
    if (httpRequestD.readyState == 0){
        console.log("Envoie en cours");
    } else if (httpRequestD.readyState == 1) {
        console.log("En attente du serveur");
    } else if (httpRequestD.readyState == 2){
        console.log("Réception des premiers éléments");
    } else if (httpRequestD.readyState == 3){
        console.log("Chargement en cours");
    } else if (httpRequestD.readyState == 4) {
        if (httpRequestD.status === 200) {
            let resultat = JSON.parse(httpRequestD.responseText);
            resultat.forEach(element => {
                affTicketAll(element,"finished");
            });
            return;
        } else {
            document.getElementById("finished").innerHTML += "<article>Il n'y a pas de nouveaux tickets.</article>";
            return
        }
    } else {
        console.log("Erreur de httpRequest, essayez de mettre a jour votre navigateur ou d'en changer.");
    }
}

function affTicketAll(rst,id){
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

function cutPeople(strPseudo, strLink){
    let arrPseudo = strPseudo.str(",");
    let len = arrPseudo.length
    let arrLink = strLink.str(",");
    let arr = "";
    for(let i = 0; i <= len; i++){
        arr += `<a href="`+arrLink[i]+`" target="_blank">`+arrPseudo[i]+`</a>`;
    }
    return arr;
}