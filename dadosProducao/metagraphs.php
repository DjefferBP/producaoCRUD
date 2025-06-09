<?php
$meta = $_SESSION['meta'][0] ?? 1000;
$producao = array_sum($_SESSION['quantidades'] ?? [0]);
$percentual = $meta > 0 ? round(($producao / $meta) * 100) : 0;
?>
<html>
  <head>
    <link rel="stylesheet" href="../styles/inicial.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Meta', <?php echo $percentual;?>],
      ]);

      var formatter = new google.visualization.NumberFormat({
        suffix: '%',
        fractionDigits: 0
      });
      formatter.format(data, 1);

        var options = {
          width: 400,
          height: 350,
          min: 0,
          max: 100,
          redFrom: 0, redTo: 60,
          yellowFrom: 60, yellowTo: 80,
          greenFrom: 80, greenTo: 100,
          minorTicks: 0,
          majorTicks: ['0%', '20%', '40%', '60%', '80%', '100%'],
          backgroundColor: { fill: 'transparent' },
          greenColor: '#B6E2A1',
          yellowColor: '#FFD966',
          redColor: '#DA6C6C'
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div_meta'));
        chart.draw(data, options);
      }
    </script>
    <style>
      #chart_div_meta {
        display: flex;
        justify-content: center;
      }
    </style>
  </head>
  <body>
    <h2 style="text-align: center; font-size: 18px; font-weight: bold" class="profile-title">Meta de Produção</h2>
    <div id="chart_div_meta"></div>
    <?php
    if ($percentual < 60) {
        echo "<h4 style='color: #DA6C6C; font-size: 18px; margin-left: 2em;'><b>A produção atual não está fluindo conforme a meta!</b></h4>";
    } elseif ($percentual < 80) {
        echo "<h4 style='color: #FFD966; font-size: 18px'; margin-left: 2em;><b>A produção atual está perto de fluir conforme a meta.</b></h4>";
    } else {
        echo "<h4 style='color: #B6E2A1; font-size: 18px'; margin-left: 2em;><b>A produção atual está fluindo conforme a meta!</b></h4>";
    }
    ?>
  </body>
</html>