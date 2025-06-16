<?php
if (empty($_SESSION['dadosNovos'])) {
  $quantidade = $_SESSION['quantidades'];
  $prejuizo = $_SESSION['prejuizos'];
  $data_registro = $_SESSION['datasRegistros'];
  $dados = [];
  for ($i = 0; $i < count($quantidade); $i++) {
    $dados[] = [
      'quantidade' => $quantidade[$i],
      'prejuizo' => $prejuizo[$i],
      'data' => $data_registro[$i],
    ];
  }
  $datapt = array_slice($dados, 0, 7);
} else {
  $dadosNovos = $_SESSION['dadosNovos'];
  $dados = [];
  for ($i = 0; $i < count($dadosNovos); $i++) {
    $dados[] = [
      'quantidade' => $dadosNovos[$i]['quantidade'],
      'prejuizo' => $dadosNovos[$i]['prejuizo'],
      'data' => $dadosNovos[$i]['dia'],
    ];
  }
  $datapt = array_slice($dados, -8);
}

?>

<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Produção', 'Prejuizo'],
        <?php
        foreach ($datapt as $point) {
          echo "['" . addslashes($point['data']) . "', " . $point['quantidade'] . ", " . $point['prejuizo'] . "],";
        }
        ?>
      ]);

      var options = {
        title: 'Produção geral',
        hAxis: {
          title: 'Datas',
          titleTextStyle: {
            color: '#333'
          }
        },
        vAxis: {
          minValue: 0
        },
        legend: {
          position: 'top'
        },
      };

      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
  <style>
    @media (min-width: 1440px) and (max-width: 1727px) {
      #chart_div {
        width: 23em;
        height: 8.5em;
      }

    }

    @media (min-width: 1728px) {
      #chart_div {
        width: 30em;
        height: 12.3em;
      }
    }
  </style>
</head>

<body>
  <div id="chart_div"></div>
</body>

</html>
