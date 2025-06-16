<?php
    $nomes = $_SESSION['nomesUser'];
    $qt = $_SESSION['quantidades'];
    $prejuizo = $_SESSION['prejuizos'];
    $email = $_SESSION['emailUser'];
    
    $dados = [];
    $emailsProcessados = [];
    
    for ($i = 0; $i < count($nomes); $i++) {
        if (in_array($email[$i], $emailsProcessados)) {
            continue;
        }
        
        $dados[] = [
            'email' => $email[$i],
            'nome' => $nomes[$i],
            'quantidade' => $qt[$i],
            'prejuizo' => $prejuizo[$i],
            'indice' => $i 
        ];
        
        $emailsProcessados[] = $email[$i]; 
    }
    
    usort($dados, function($a, $b) {
        return $b['quantidade'] - $a['quantidade'];
    });
    
    $dataPoints = array_slice($dados, 0, 7);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Funcionário', 'Produção', 'Retrabalho'],
      <?php
        foreach ($dataPoints as $point) {
            echo "['".addslashes($point['nome'])."', ".$point['quantidade'].", ".$point['prejuizo']."],";
        }
      ?>
    ]);

    var options = {
      title: 'Performance dos funcionários',
      subtitle: 'Top 7 funcionários com maior produção',
      bars: 'horizontal',
      legend: { position: 'top' },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
    chart.draw(data, options);
  }
</script>
  <style>
    @media (min-width: 1440px) and (max-width: 1727px) {
      #columnchart_material {
        width: 23em;
        height: 10em;
      }

    }

    @media (min-width: 1728px) {
      #columnchart_material {
        width: 30em;
        height: 12.5em;
      }
    }
  </style>
  </head>
  <body>
    <div id="columnchart_material"></div>
  </body>
</html>
