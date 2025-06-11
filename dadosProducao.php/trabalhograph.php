<?php
//Esse arquivo gera um gráfico de barras com os dados de produção dos funcionários, nomeando cada um deles e apresentando o número de sapatos produzidos,
//o percentual de sucesso e o percentual de refugo.
// Código que vai buscar os dados de produção dos funcionários e atrelá-los ao gráfico
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$trabalhador = $_SESSION['nomesUser'] ?? null;
$sapatosProduzidos = $_SESSION['quantidades'] ?? null;
$prejuizo = $_SESSION['prejuizo'] ?? null;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Motivation and Energy Level Chart</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chart_div2 {
            width: 100%;
            height: 25em;
        }
    </style>
    <script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawMultSeries);

    function drawMultSeries() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Trabalhador');
        data.addColumn('number', 'Sapatos Produzidos com sucesso');
        data.addColumn('number', 'Percentual de Refugo');

        data.addRows([
            <?php
            if (is_array($trabalhador) && is_array($sapatosProduzidos) && is_array($prejuizo)) {
                for ($i = 0; $i < count($trabalhador); $i++) {
                    $nome = addslashes($trabalhador[$i]);
                    $produzidos = (int) $sapatosProduzidos[$i];
                    $refugo = (float) $prejuizo[$i];
                    echo "['{$nome}', {$produzidos}, {$refugo}]";
                    if ($i < count($trabalhador) - 1) echo ",";
                }
            }
            ?>
        ]);

        var options = {
            title: 'Desempenho dos funcionários',
            colors: ['#B6E2A1', '#DA6C6C'],
            hAxis: {
                title: 'Funcionários'
            },
            vAxis: {
                title: 'Quantidade / Percentual'
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div2'));

        chart.draw(data, options);
    }
</script>
</head>

<body>
    <div id="chart_div2"></div>
</body>

</html>
