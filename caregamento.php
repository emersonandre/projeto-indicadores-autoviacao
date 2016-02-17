<html lang="pt-BR">

<head>

    <link href="css/style.css">
</head>
<body>
    
        <div id="conteudo">
            <img src="./img/carregando.gif">
        </div>

        <script>
            $(document).ready(function(){

                //Esconde preloader
                $(window).load(function(){
                    $('#tbldinamica').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
                });

            });
            
            </script>

</body>
</html>