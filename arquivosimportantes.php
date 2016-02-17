<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    
    <div class="panel-body">
                                <div class="flot-chart" >
                                    
                                    <div>
                                        <canvas id="fatRolito" style="max-width:100%; max-height:100%;" width="2000" height="400"></canvas>
                                   
                                </div>
                                </div>
                            </div>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS 
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
    <div id="grafico" class="container" >
        <canvas id="fatRolito" style="max-height: 100%; max-width: 100%" width="1000" height="500" >  
            </canvas>
    </div>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="Chart/Chart.js"></script>
    <script type="text/javascript">
        //declaracao variaveis
        var meses = Array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
        var cont = 0;
        var data = new Date();
        var mes = data.getMonth();
        var ano = data.getFullYear();
        var labelMeses = '';
        
        while(cont < 12){
            
            //escreve primeira parte do label se nao for  final
            if(cont<11){
                labelMeses += meses[mes]+',';//escreve com virgula
            }else{
                labelMeses += meses[mes]+'';//escreve sem virgula no final
            }
            
            
            if(mes == 0){
                mes = 11;
                ano = ano - 1;
            }else{
                mes = mes - 1;
            }
            cont++;
        }
        alert(labelMeses);
        
        setInterval(function(){
            $.ajax({
                dataType:'json',
                url: './ajax/ajaxFaturamentoRolito.php',
                timeout: '30000',
                error: function(){
                    alert('Um erro Ocorreu, recarregue a pagina!');
                },
                success: function(retorno){
                    
                    //montagem grafico linhas
                    var lineChartData = {
                    labels : labelMeses,
                    datasets : [
                        {
                            label: "Faturamento",
                            fillColor : "#C1CDCD",
                            strokeColor : "#0000CD",
                            pointColor : "#00CD00",
                            pointStrokeColor : "#D3D3D3",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : retorno
                        }
                    ]

            };

	function grafico(){
                var defaultOptions = {
		Chart: {
			zoomEnabled: false,
			zoomType: "x",
			backgroundColor: "white",
			theme: "theme1",
			animationEnabled: false,
			animationDuration: 1200,

			dataPointWidth: null,
			dataPointMinWidth: null,
			dataPointMaxWidth: null,

			colorSet: "colorSet1",
			culture: "en",
			creditText: "CanvasJS.com",
			interactivityEnabled: true,
			exportEnabled: false,
			exportFileName: "Chart",

			rangeChanging: null,
			rangeChanged: null
		},

		Title: {
			padding: 0,
			text: null,
			verticalAlign: "top",//top, center, bottom
			horizontalAlign: "center",//left, center, right
			fontSize: 20,//in pixels
			fontFamily: "Calibri",
			fontWeight: "normal", //normal, bold, bolder, lighter,
			fontColor: "black",
			fontStyle: "normal", // normal, italic, oblique

			borderThickness: 0,
			borderColor: "black",
			cornerRadius: 0,
			backgroundColor: null,
			margin: 5,
			wrap: true,
			maxWidth: null,

			dockInsidePlotArea: false
			//toolTipContent: null//string - To be implemented (TBI)
		},

		Subtitle: {
			padding: 0,
			text: null,
			verticalAlign: "top",//top, center, bottom
			horizontalAlign: "center",//left, center, right
			fontSize: 14,//in pixels
			fontFamily: "Calibri",
			fontWeight: "normal", //normal, bold, bolder, lighter,
			fontColor: "black",
			fontStyle: "normal", // normal, italic, oblique

			borderThickness: 0,
			borderColor: "black",
			cornerRadius: 0,
			backgroundColor: null,
			margin: 2,
			wrap: true,
			maxWidth: null,

			dockInsidePlotArea: false
			//toolTipContent: null//string - To be implemented (TBI)
		},

		Legend: {
			name: null,
			verticalAlign: "center",
			horizontalAlign: "right",

			fontSize: 14,//in pixels
			fontFamily: "calibri",
			fontWeight: "normal", //normal, bold, bolder, lighter,
			fontColor: "black",
			fontStyle: "normal", // normal, italic, oblique

			cursor: null,
			itemmouseover: null,
			itemmouseout: null,
			itemmousemove: null,
			itemclick: null,

			dockInsidePlotArea: false,
			reversed: false,

			maxWidth: null,
			maxHeight: null,

			itemMaxWidth: null,
			itemWidth: null,
			itemWrap: true,
			itemTextFormatter: null
		},

		ToolTip: {
			enabled: true,
			shared: false,
			animationEnabled: true,
			content: null,
			contentFormatter: null,

			reversed: false,

			backgroundColor: null,

			borderColor: null,
			borderThickness: 2, //in pixels
			cornerRadius: 5, // in pixels

			fontSize: 14, // in pixels
			fontColor: null,
			fontFamily: "Calibri, Arial, Georgia, serif;",
			fontWeight: "normal", //normal, bold, bolder, lighter,
			fontStyle: "italic"  // normal, italic, oblique
		},

		Axis: {
			minimum: null, //Minimum value to be shown on the Axis
			maximum: null, //Minimum value to be shown on the Axis
			viewportMinimum: null,
			viewportMaximum: null,
			interval: null, // Interval for tick marks and grid lines
			intervalType: null, //number, millisecond, second, minute, hour, day, month, year
			//reversed: false,

			title: null, // string
			titleFontColor: "black",
			titleFontSize: 20,
			titleFontFamily: "arial",
			titleFontWeight: "normal",
			titleFontStyle: "normal",

			labelAngle: 0,
			labelFontFamily: "arial",
			labelFontColor: "black",
			labelFontSize: 12,
			labelFontWeight: "normal",
			labelFontStyle: "normal",
			labelAutoFit: false,
			labelWrap: true,
			labelMaxWidth: null,//null for auto
			labelFormatter: null,

			prefix: "",
			suffix: "",

			includeZero: true, //Applies only for axisY. Ignored in axisX.

			tickLength: 5,
			tickColor: "black",
			tickThickness: 1,

			lineColor: "black",
			lineThickness: 1,
			lineDashType: "solid",

			gridColor: "A0A0A0",
			gridThickness: 0,
			gridDashType: "solid",

			interlacedColor: null,

			valueFormatString: null,

			margin: 2,

			stripLines: [] // Just a placeholder. Does not have any effect on the actual number of striplines      
		},

		StripLine: {
			value: null,
			startValue: null,
			endValue: null,

			color: "orange",
			opacity: null,
			thickness: 2,
			lineDashType: "solid",
			label: "",
			labelBackgroundColor: "#EEEEEE",
			labelFontFamily: "arial",
			labelFontColor: "orange",
			labelFontSize: 12,
			labelFontWeight: "normal",
			labelFontStyle: "normal",
			labelFormatter: null,

			showOnTop: false
		},

		DataSeries: {
			name: null,
			dataPoints: null,
			label: "",
			bevelEnabled: false,
			highlightEnabled: true,

			cursor: null,

			indexLabel: "",
			indexLabelPlacement: "auto",  //inside, outside, auto       
			indexLabelOrientation: "horizontal",
			indexLabelFontColor: "black",
			indexLabelFontSize: 12,
			indexLabelFontStyle: "normal", //   italic ,oblique, normal 
			indexLabelFontFamily: "Arial", 	// fx: Arial Verdana "Courier New" Serif 
			indexLabelFontWeight: "normal", 	// bold ,bolder, lighter, normal 
			indexLabelBackgroundColor: null,
			indexLabelLineColor: null,
			indexLabelLineThickness: 1,
			indexLabelLineDashType: "solid",
			indexLabelMaxWidth: null,
			indexLabelWrap: true,
			indexLabelFormatter: null,

			lineThickness: 2,
			lineDashType: "solid",

			color: null,
			risingColor: "white",
			fillOpacity: null,

			startAngle: 0,

			radius: null,
			innerRadius: null,

			type: "column", //line, column, bar, area, scatter stackedColumn, stackedBar, stackedArea, stackedColumn100, stackedBar100, stackedArea100, pie, doughnut
			xValueType: "number", //number, dateTime
			axisYType: "primary",

			xValueFormatString: null,
			yValueFormatString: null,
			zValueFormatString: null,
			percentFormatString: null,

			showInLegend: null,
			legendMarkerType: null,
			legendMarkerColor: null,
			legendText: null,
			legendMarkerBorderColor: null,
			legendMarkerBorderThickness: null,

			markerType: "circle", //none, circle, square, cross, triangle, line
			markerColor: null,
			markerSize: null,
			markerBorderColor: null,
			markerBorderThickness: null,
			//animationEnabled: true,
			mouseover: null,
			mouseout: null,
			mousemove: null,
			click: null,
			toolTipContent: null,

			visible: true
		},

		//Private
		TextBlock: {
			x: 0,
			y: 0,
			width: null,//read only
			height: null,//read only
			maxWidth: null,
			maxHeight: null,
			padding: 0,
			angle: 0,
			text: "",
			horizontalAlign: "center",//left, center, right
			fontSize: 12,//in pixels
			fontFamily: "calibri",
			fontWeight: "normal", //normal, bold, bolder, lighter,
			fontColor: "black",
			fontStyle: "normal", // normal, italic, oblique

			borderThickness: 0,
			borderColor: "black",
			cornerRadius: 0,
			backgroundColor: null,
			textBaseline: "top"
		},

		CultureInfo: {
			decimalSeparator: ".",
			digitGroupSeparator: ",",
			zoomText: "Zoom",
			panText: "Pan",
			resetText: "Reset",

			menuText: "More Options",
			saveJPGText: "Save as JPEG",
			savePNGText: "Save as PNG",

			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			shortDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

			labelMeses: ["Janeiro", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		}
                };
		var ctx = document.getElementById("fatRolito").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, defaultOptions);
               // defaultOptions.responsive:true;
	};
        
        grafico();

                    
                    
                }
                
            });
            
            
            
            
        },5000);
        
        
    </script>
</body>

</html>
