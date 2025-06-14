<?php
    session_start();
    $diasRegistros = $_SESSION['datasRegistros'];
    $qt = $_SESSION['quantidades'];
    $horasTra = $_SESSION['horas'];
    $mediaProd = [];
    $datasProcessadas = [];

    for ($i = 0; $i < count($qt); $i++) {
        $dataAtual = $diasRegistros[$i];

        if (in_array($dataAtual, $datasProcessadas)) {
            continue;
        }

        $totalQt = 0;
        $totalHoras = 0;
        for ($j = 0; $j < count($qt); $j++) {
            if ($diasRegistros[$j] == $dataAtual) {
                $totalQt += $qt[$j];
                $totalHoras += $horasTra[$j];
            }
        }

        $somaHora = $totalHoras * 60;
        $mediaHoras = $somaHora > 0 ? $totalQt / $somaHora : 0;

        $mediaProd[] = [
            'data' => $dataAtual,
            'media' => $mediaHoras
        ];
        $datasProcessadas[] = $dataAtual;
    }
    $_SESSION['mediaProd'] = $mediaProd;
    $diretorio = 'dadosProducao/';
    file_put_contents($diretorio . 'mediaProd.json', json_encode($_SESSION['mediaProd'], JSON_PRETTY_PRINT));
    header('Location: sair.php');
