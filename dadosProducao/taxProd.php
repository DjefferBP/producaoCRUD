<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $mediaHoras = $_SESSION['producaoHr'];
  if (!isset($_SESSION['dadosNovos'])){
    $mediaProducao = [];
    $datahr = [];
    for ($i = 0; $i < count($mediaHoras); $i++) {
      $datahr[] = $mediaHoras[$i]['data'];
      $mediaProducao[] = $mediaHoras[$i]['mediaProd'];
    }
  } elseif (isset($_SESSION['dadosNovos']) && count($_SESSION['dadosNovos']) == 0){
    $mediaProducao = [];
    $datahr = [];
    for ($i = 0; $i < count($mediaHoras); $i++) {
      $datahr[] = $mediaHoras[$i]['data'];
      $mediaProducao[] = $mediaHoras[$i]['mediaProd'];
    }
  } else {
    $datahr = $_SESSION['dadosNovos'];
    $mediahr = $_SESSION['producaoHr'];
    $mediaProducao = [];
    for ($i = 0; $i < count($mediaProducao); $i++) {
      $mediaProducao[] = $mediahr[$i]['mediaProd'];
    }
  }
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        
        
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Taxa de Produção'],
          ['12/06',  0.05],
        ]);

        var options = {
          title: 'Taxa de produção de sapatos',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 30em; height: 12em"></div>
  </body>
</html>