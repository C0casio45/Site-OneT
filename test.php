<html>
<head>
<link rel="stylesheet" href="assets/css/message.css">
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <div id="imgcont">
                <input onchange="updateImageDisplay(this)" type="file" name="clue"  id="img" accept=".png,.jpg,.jpeg">
                <div id="imgprev" hov="url('../data/img.svg')" ></div>
            </div>
            <input type="text" name="message" id="message">
            <input type="submit" name="submit" value="" id="send">
    </form>
    <script>
        
        let preview = document.getElementById("imgprev");

        function updateImageDisplay(e) {

        let curFiles = e.files;
        if(curFiles.length === 0) {
            preview.style.backgroundColor = "#ff4c42";
        } else {
            for(var i = 0; i < curFiles.length; i++) {
                if(validFileType(curFiles[i])) {
                    var image = document.createElement('uploadImage');
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

        // function send(){
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //             document.getElementById("demo").innerHTML = this.responseText;
        //         }
        //     };
        //     xhttp.open("POST", "demo_post2.asp", true);
        //     xhttp.setRequestHeader("Content-type", "multipart/form-data");
        //     xhttp.send("fname=Henry&lname=Ford");
        // }
    </script>
    <?php
    print_r($_POST);
    echo '</br>';
    print_r($_FILES);
    ?>
</body>
</html>



