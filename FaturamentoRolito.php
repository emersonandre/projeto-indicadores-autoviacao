<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="grafico" class="container">
        <div class="panel-body panel-default">
            <canvas id="fatRolito" >  
            </canvas>  
            </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="Chart/Chart.js"></script>
    <script type="text/javascript">
        var dataAtual = new
        
        //declaracao variaveis
        var label1,label2,label3,label4,label5,label6,label7,label8,label9,label10,label11,labelAtual;
        var mes1,mes2,mes3,mes4,mes5,mes6,mes7,mes8,mes9,mes10,mes11,mesAtual; 
        
        setInterval(function(){
            $.ajax({
                dataType:'json',
                url: './ajax/ajaxFaturamentoRolito.php',
                timeout: '30000',
                error: function(){
                    alert('Um erro Ocorreu, recarregue a pagina!');
                },
                success: function(retorno){
                    
                    //var dados = json_decode(retorno);
                     
                    //montagem grafico linhas
                    var lineChartData = {
                    labels : [label1,label2,label3,label4,label5,label6,label7,label8,label9,label10,label11,labelAtual],
                    datasets : [
                        {
                            label: "Faturamento",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(222,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "##D3D3D3",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : retorno
                        }
                    ]

            };

	function grafico(){
                var options = {
                        width: 400,
                        height: 400,
                        responsive: true
                    };
		var ctx = document.getElementById("fatRolito").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, options);
	};
        
        grafico();

                    
                    
                }
                
            });
            
            
            
            
        },5000);
        
        
    </script>
</body>

</html>
