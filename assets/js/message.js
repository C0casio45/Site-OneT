const msg_len = 4;
let inf = document.getElementById('infos');
let msg = document.getElementById('messages');
let result = "";
let pseudo = document.getElementById('pseudo').innerHTML;
let preview = document.getElementById("imgprev");
input = document.getElementById("img");
input.addEventListener('change', updateImageDisplay);

inf.innerHTML = `
<p>N° : `+infoTicket[0]+`</p>
<p>État : `+statusOfTicket(infoTicket[1])+`</p>
<p><a href="`+infoTicket[2]+`">Lien de la partie</a></p>
<p>Création du ticket : `+timeTranslator(infoTicket[3])+`</p>
<p>Fermeture du ticket : `+timeTranslator(infoTicket[4])+`</p>
<p>Sanction : `+infoTicket[5]+`</p>
`+cutPeople(infoTicket[6],infoTicket[7])+`
<p>Type : `+infoTicket[8]+`</p>
`

messagesAff(messages,msg_len)

function messagesAff(arr,len){
    let l = arr.length;
    l /= len;
    for(let i = 0; i<l;i++){
        if(messages[0+(4*i)] == pseudo){$classe = "my";}else{$classe="";}
        msg.innerHTML += `
        <div class="message `+ $classe +`">
        <p>De : `+messages[0+(4*i)]+`</p>
        <p>Envoyé a : `+timeTranslator(messages[2+(4*i)])+`</p>
        <p>`+cutMessage(messages[3+(4*i)])+`</p>
        </div>
        `
    }
}

function statusOfTicket(e){
    switch (e) {
        case "0":
            return "Nouveau";
            break;
        case "1":
            return "En cours de traitement";
            break;
        case "2":
            return "Fini";
            break;
        case "3":
            return "Archivé";
            break;
    
        default:
            return "Erreur"
            break;
    }
}

function timeTranslator(time){
    if(time == ""){
        return "NaN"
    }
    var dateStr=time;
    var a=dateStr.split(" ");
    var d=a[0].split("-");
    var t=a[1].split(":");
    return t[0]+':'+t[1]+':'+t[2]+' le '+d[0]+'/'+(d[1]-1)+'/'+d[2]
}

function cutPeople(strPseudo, strLink){
    let arrPseudo = strPseudo.split(",");
    let len = arrPseudo.length
    let arrLink = strLink.split(",");
    let arr = "";
    if(len > 1){
        st = "<p>Accusés : "
    } else {
        st = "<p>Accusé : "
    }
    for(let i = 0; i < len; i++){
        arr += `<a href="`+arrLink[i]+`" target="_blank">`+arrPseudo[i]+`</a> `;
    }
    return st + arr + "</p>";
}

function cutMessage(msg){
    if(msg.indexOf("||") !== -1 ){
        let arrMsg = msg.split("||");
        return arrMsg[0] + '</p><div class="imgmsg"><img src="'+arrMsg[1]+'" alt="Image preuve"?></div><p>';
    } else {
        return msg + msg.indexOf("||");
    }
}



function updateImageDisplay() {

    var curFiles = input.files;
    if(curFiles.length === 0) {
        preview.style.backgroundColor = "#ff4c42";
    } else {
        for(var i = 0; i < curFiles.length; i++) {
        if(validFileType(curFiles[i])) {
            var image = document.createElement('img');
            image.src = window.URL.createObjectURL(curFiles[i]);
        } else {
            console.log("File Type Not Valid");
            
        }
        preview.style.backgroundImage = "url("+image.src+")"
        preview.innerHTML += '<span onclick="Reinit()" class="delete" id="cl" >X</span>' ;
        }
    }
}

var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
]

function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
        if(file.type === fileTypes[i]) {
            return true;
        }
    }
    return false;
}

function Reinit() {
    document.getElementById('cl').remove();
    preview.style.backgroundImage = 'url(assets/data/imgb.svg)';
}

function affForm(){
    document.getElementById('formEnd').style.display = "block";
}

function hideForm(){
    document.getElementById('formEnd').style.display = "none";
}
