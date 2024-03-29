let input = document.getElementById("myFile");
var preview = document.getElementById("ppcont");

input.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    while(preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    var curFiles = input.files;
    if(curFiles.length === 0) {
        var para = document.getElementById("FileWrapper");
        para.setAttribute('data-before', 'No files currently selected for upload');
        preview.appendChild(para);
        console.log("z")
    } else {
        for(var i = 0; i < curFiles.length; i++) {
        var para = document.getElementById("FileWrapper");
        if(validFileType(curFiles[i])) {
            para.setAttribute('data-before', curFiles[i].name + ', size : ' + returnFileSize(curFiles[i].size) + '.');
            var image = document.createElement('img');
            image.src = window.URL.createObjectURL(curFiles[i]);
        } else {
            para.setAttribute('data-before', curFiles[i].name + ': Not a valid file type. Update your selection.');
            
        }
        preview.appendChild(image)
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

function returnFileSize(number) {
    if(number < 1024) {
        return number + ' octets';
    } else if(number >= 1024 && number < 1048576) {
        return (number/1024).toFixed(1) + ' Ko';
    } else if(number >= 1048576) {
        return (number/1048576).toFixed(1) + ' Mo';
    }
}

function affForm(){
    document.getElementById('ff').style.display="block";
    document.getElementById('btn').style.display="none";
}