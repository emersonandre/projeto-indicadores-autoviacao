<!DOCTYPE html>
<html lang="en">

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
        <div id="page-wrapper">

            

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tables
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Tables
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Tabela Dinamica Valores</h2>
                        <div id="carregamento">
                            <img src="./img/carregando.gif">
                        </div>
                        <div  id="tbldinamica">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2>Tabela Dinamica Volumes</h2>
                        <div id="tblvolumes">
                            
                        </div>
                    </div>
                </div>
                
                <!-- /.row -->

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script> 
       
    $(document).ready(function() {
            $("#tbldinamica").load("./ajax/ajaxTabelaDinamica.php");
            $('#carregamento').hide();
        });
    $(document).ready(function() {
            $("#testediv2").load("./ajax/ajaxTabelaDinamica.php");
            $('#carregamento').hide();
        });
    </script>
    
    <script>
            $(document).ready(function(){
                $(window).load(function(){
                    $('#tbldinamica').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
                });

            });
            
     </script>
    
    <script>
           
     $(document).ready(function(){
	$('#tbldinamica').tablesorter();
     });
    
      
        
        </script>

</body>

</html>
