<?php
$quantidade = $_SESSION['quantidades'];
$somaQt = array_sum($quantidade);
$retrabalho = $_SESSION['prejuizos'];
$somaRe = array_sum($retrabalho);
?>

<html>

<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
      'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Produção', <?php echo isset($somaQt) && isset($somaRe) ? ($somaQt - $somaRe) : 0; ?>],
        ['Retrabalho total', <?php echo isset($somaRe) ? $somaRe : 0 ?>],
      ]);

      // Set chart options
      var options = {
        'title': 'Informações',
        slices: {
          0: {
            color: '#B6E2A1'
          },
          1: {
            color: '#DA6C6C'
          }
        },
        backgroundColor: 'transparent',
        pieHole: 0.4,
      }

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_prod'));
      chart.draw(data, options);
    }
  </script>
  <style>
    :root {
      --corPrimaria: #9301fd;
      --corSecundaria: #b95afd;
      --corContorno: #d9d9d9;
      --corFundo: #ffffff;
    }

    @media (min-width: 1440px) and (max-width: 1727px) {
      #chart_div_prod {
        width: 23em;
        height: 10em;
      }

    }

    @media (min-width: 1728px) {
      #chart_div_prod {
        width: 30em;
        height: 15em;
      }
    }
  </style>
</head>

<body>
  <!--Div that will hold the pie chart-->
  <div id="chart_div_prod"></div>
</body>

</html>
