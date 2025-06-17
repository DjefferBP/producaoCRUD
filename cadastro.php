<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (in_array($email, $_SESSION['emailTrabalhador'])){
            echo "<script>alert('Este e-mail já está cadastrado, tente novamente!');</script>";
            echo "<script>window.location.href='paginas/funcionarios.php';</script>";
            exit();
        }
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            $tiposPermitidos = ['jpg', 'png'];
            if (in_array($ext, $tiposPermitidos)) {
                
                $novoNome = uniqid('user_') . '.' . $ext;
                $destino = 'usuarios/' . $novoNome;
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                    array_push($_SESSION['fotoTra'], $destino);
                }else {
                    echo "<script>alert('Erro ao mover o arquivo para a pasta usuarios!');</script>";
                }
            } else {
                echo "<script>alert('Tipo de arquivo não permitido! Envie apenas PNG ou JPG.');</script>";
            }
        }
        $diretorio = 'dadosUserjson/';
        array_push($_SESSION['nomeTrabalhador'], $nome);
        array_push($_SESSION['emailTrabalhador'], $email);
        array_push($_SESSION['senhaTrabalhador'], $senha);
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'emailUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
        $diretorio = 'jsons/';
        file_put_contents($diretorio . 'foto.json', json_encode($_SESSION['fotoTra'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
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
        $diretorio = '../dadosProducao/';
        file_put_contents($diretorio . 'mediaProd.json', json_encode($_SESSION['mediaProd'], JSON_PRETTY_PRINT));
        header("Location: paginas/funcionarios.php");
    }