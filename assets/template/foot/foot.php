                
            </main>
            <footer>
                    <p>Site developpé et hébergé par <a href="https://twitter.com/C0casio45">@C0casio45</a> | Rejoignez nous sur ts.onetfr.fr | <a href="legal.php">Mentions Légales</a></p>
            
            </footer>
            <script>
                let i = 1;
                function ischecked(){
                    let bod = document.getElementById("page-container");

                    if (i == 1){
                        window.scrollTo(0, 0)
                        setTimeout(() => {bod.style.overflowY = "hidden"}, 290);
                        i = 0;
                    } else {
                        bod.style.overflowY = "auto";
                        i = 1;
                    }
                }
            </script>
    </body>
</html>