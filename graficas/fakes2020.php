<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Fake News USA</title>

		<style type="text/css">
#container {
  height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="code/highcharts.js"></script>
<script src="code/highcharts-3d.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Se define el grafico referente a las fake news en elecciones en USA.
    </p>
</figure>

<?php
include ("conex.php");

//$query = "SELECT SUBSTR(cuando,1,(instr(cuando,','))-1) as MES, SUBSTR(cuando,(instr(cuando,',')+1), 4) AS ANO, COUNT(*) AS TOTAL FROM bdatos GROUP BY MES ORDER BY TOTAL DESC LIMIT 4";

$query = "SELECT SUBSTR(cuando,1,(instr(cuando,','))-1) as MES, SUBSTR(cuando,(instr(cuando,',')+1), 4) AS AnO, COUNT(*) AS TOTAL FROM bdatos WHERE CUANDO LIKE '%%2020' GROUP BY ANO, MES ORDER BY TOTAL DESC LIMIT 4";

//$str = "SELECT SUBSTR(cuando,1,(instr(cuando,','))-1) as MES, SUBSTR(cuando,(instr(cuando,',')+1), 4) AS AnO, COUNT(*) AS TOTAL FROM bdatos WHERE CUANDO LIKE '%2020' GROUP BY ANO, MES ORDER BY TOTAL DESC LIMIT 4";

//$query = addslashes($str);
  
$result = mysqli_query($conn, $query) or die(mysqli_error());

//$result = mysqli_query($conn, "SELECT SUBSTR(cuando,1,(instr(cuando,','))-1) as MES, SUBSTR(cuando,(instr(cuando,',')+1), 4) AS ANO, COUNT(*) AS TOTAL FROM bdatos GROUP BY ANO, MES ORDER BY TOTAL DESC LIMIT 4") or die(mysqli_error()); 
 
?>


		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Porcentaje de Fake News publicadas por meses en campaña electoral del año 2020.'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Fake news',
        data: [

        <?php


			while ($row = mysqli_fetch_array($result)) { 
				//echo "['".$row['MES']."',".$row['ANO']."',".$row['TOTAL']."],";
				echo "['".$row['MES']."',".$row['TOTAL']."],";

			  }    

	    ?>

        ]
    }]
});
		</script>
	</body>
</html>
