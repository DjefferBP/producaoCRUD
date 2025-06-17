<?php
if (empty($_SESSION['dadosNovos'])) {
    $mediaProd = $_SESSION['mediaProd'];
    $reg = count($mediaProd);
    $max = 7;
    $dataPoints = [];
    for ($i = 0; $i < $max; $i++) {
        $idx = $reg - 1 - $i;
        if ($idx >= 0) {
            $dataPoints[] = [
                'data' => $mediaProd[$idx]['data'],
                'media' => $mediaProd[$idx]['media']
            ];
        }
    }
    $data = array_slice($dataPoints, -8);
} else {
    $datasProcessadas = [];
    foreach ($_SESSION['dadosNovos'] as $dado) {
        if (!in_array($dado['dia'], $datasProcessadas)) {
            $datasProcessadas[] = $dado['dia'];
        }
    }
    
    $datasRecentes = array_slice($datasProcessadas, -7);
    $dataPoints = [];
    foreach ($datasRecentes as $data) {
        $media = 0;
        foreach ($_SESSION['mediaProd'] as $item) {
            if ($item['data'] == $data) {
                $media = $item['media'];
                break;
            }
        }
        $dataPoints[] = ['data' => $data, 'media' => $media];
    }
    $data = array_slice($dataPoints, -8);
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
      <?php
      foreach ($data as $point) {
        echo "['".$point['data']."', ".round($point['media'], 2)."],";
      }
      ?>
    ]);

    var options = {
      title: 'Taxa de produção de sapatos',
      curveType: 'function',
      legend: { position: 'bottom' },
      hAxis: {
        slantedText: false,
        textStyle: { fontSize: 8, color: '#222' }
      },
      vAxis: {
        textStyle: { fontSize: 12, color: '#222' }
      },
      pointSize: 7,
      lineWidth: 3,
      legendTextStyle: { fontSize: 14 },
      titleTextStyle: { fontSize: 18 }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
  </script>
    <style>
    @media (min-width: 1440px) and (max-width: 1727px) {
      #curve_chart {
        width: 23em;
        height: 8em;
      }

    }

    @media (min-width: 1728px) {
      #curve_chart {
        width: 30em;
        height: 12.5em;
      }
    }
  </style>
</head>
<body>
  <div id="curve_chart"></div>
</body>
</html>
