<?php
    session_start();
    if (!isset($_SESSION['dadosNovos'])){
        $qt = $_SESSION['quantidades'];
        $horasTra = $_SESSION['horas'];
        $somaQt = array_sum($qt);
        $somaHoras = array_sum($horasTra) * 60;
        $mediaHoras = $somaQt / $somaHoras;
    } elseif (isset($_SESSION['dadosNovos']) && count($_SESSION['dadosNovos']) == 0) {
        $qt = $_SESSION['quantidades'];
        $horasTra = $_SESSION['horas'];
        $somaQt = array_sum($qt);
        $somaHoras = array_sum($horasTra) * 60;
        $mediaHoras = $somaQt / $somaHoras;
    } else {
        $dado = $_SESSION['dadosNovos'];
        $qt = [];
        $horasTra = [];
        for ($index = 0; $index < count($dado); $index++) {
            array_push($qt, $dado[$index]['quantidade']);
            array_push($horasTra, $dado[$index]['horas']);
        }
        $somaHoras = array_sum($horasTra) * 60;
        $somaQt = array_sum($qt);
        $mediaHoras = $somaQt / $somaHoras;
    }
    $dadosProducao = [];
    date_default_timezone_set('America/Sao_Paulo');
    $dataHr = date('d/m/Y');
    $horahj = [$dataHr];
    array_push($dadosProducao, [
        'data' => $horahj,
        'mediaProd' => $mediaHoras
    ]);
    $id = array_search($dataHr, array_column($dadosProducao, 'data'));
    if ($dadosProducao[$id]['data'] == $dataHr) {
        $dadosProducao[$id]['data'] = $dataHr;
        $dadosProducao[$id]['mediaProd'] = $mediaHoras;
    } else {
        array_push($_SESSION['producaoHr'], [
            'data' => $dataHr,
            'mediaProd' => $mediaHoras
        ]);
    }
    $diretorio = 'dadosProducao/';
    file_put_contents($diretorio . 'mediaProd.json', json_encode($_SESSION['producaoHr'], JSON_PRETTY_PRINT));
    header('Location: inicial.php');
