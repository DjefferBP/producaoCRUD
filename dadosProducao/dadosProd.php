<?php
    if (empty($_SESSION['dadosNovos'])){
        $quantidade = $_SESSION['quantidades'];
        $prejuizo = $_SESSION['prejuizos'];
        $data_registro = $_SESSION['datasRegistros'];
        $dados = [];
        for ($i = 0; $i < count($quantidade); $i++){
            $dados[] = [
                'quantidade'=> $quantidade[$i],
                'prejuizo' => $prejuizo[$i],
                'data' => $data_registro[$i],
            ];
        }
        $datapt = array_slice($dados, 0 , 7);

    } else {
        $dadosNovos = $_SESSION['dadosNovos'];
        $dados = [];
        for ($i = 0; $i < count($quantidade); $i++){
            $dados[] = [
                'quantidade'=> $dadosNovos[$i]['quantidade'],
                'prejuizo' => $dadosNovos[$i]['prejuizo'],
                'data'=> $dadosNovos[$i]['dia'],
            ];
        }
        $datapt = array_slice($dados, 0,7);
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
          ['Data', 'Produção', 'Prejuizo'],
          <?php
            foreach ($datapt as $point) {
                echo "['".addslashes($point['data'])."', ".$point['quantidade'].", ".$point['prejuizo']."],";
            }
          ?>
        ]);

        var options = {
          title: 'Produção geral',
          hAxis: {title: 'Datas',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 750px; height: 500px;"></div>
  </body>
</html>
