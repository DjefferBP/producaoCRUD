<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ;
        $nome = $_POST['nome'] ;
        $id = $_POST['id'] ?? '';
        
        $emailAtual = $_SESSION['emailTrabalhador'][$id];
        $nomeAtual = $_SESSION['nomeTrabalhador'][$id];
        if ($_POST['email'] != $emailAtual && in_array($email, $_SESSION['emailTrabalhador'])) {
            echo "<script>alert('Este e-mail já está cadastrado, tente novamente!');</script>";
            echo "<script>window.location.href='funcionarios.php';</script>";
            exit();
        }
        $_SESSION['nomeTrabalhador'][$id] = $nome;
        $_SESSION['emailTrabalhador'][$id] = $email;
        $_SESSION['senhaTrabalhador'][$id] = $_POST['senha'] ?? $_SESSION['senhaTrabalhador'][$id];
        if (isset($_FILES['fotoTra']) && $_FILES['fotoTra']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['fotoTra']['name'], PATHINFO_EXTENSION));
            $tiposPermitidos = ['jpg', 'png'];
            if (in_array($ext, $tiposPermitidos)) {
                $fotoAntiga = $_SESSION['fotoTra'][$id] ?? '';
                if ($fotoAntiga && file_exists($fotoAntiga)) {
                    unlink($fotoAntiga);
                }
                $novoNome = uniqid('user_') . '.' . $ext;
                $destino = 'usuarios/' . $novoNome;
                if (move_uploaded_file($_FILES['fotoTra']['tmp_name'], $destino)) {
                    $_SESSION['fotoTra'][$id] = $destino;
                }else {
                        echo "<script>alert('Erro ao mover o arquivo para a pasta usuarios!');</script>";
                }
            } else {
                echo "<script>alert('Tipo de arquivo não permitido! Envie apenas PNG ou JPG.');</script>";
            }
        }
        $fotoTra = $_SESSION['fotoTra'][$id];
        $arrayUser = [
            'emailTrabalhador',
        ];
        foreach ($arrayUser as $arr) {
            if (isset($_SESSION[$arr]) && is_array($_SESSION[$arr])) {
                foreach ($_SESSION[$arr] as $i => $valor) {
                    if ($valor === $emailAtual) {
                        $_SESSION[$arr][$i] = $email;
                    }
                }
            }
        }
        $arrayNome = [
            'nomeTrabalhador',
        ];
        foreach ($arrayNome as $arr) {
            if (isset($_SESSION[$arr]) && is_array($_SESSION[$arr])) {
                foreach ($_SESSION[$arr] as $i => $valor) {
                    if ($valor === $nomeAtual) {
                        $_SESSION[$arr][$i] = $nome;
                    }
                }
            }
        }

        $diretorio = '../dadosUserjson/';
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'emailUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
        $diretorio = 'jsons/';
        file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'foto.json', json_encode($_SESSION['fotoTra'], JSON_PRETTY_PRINT));
        echo "<script>alert('Trabalhador editado com sucesso!');</script>";
        echo "<script>window.location.href='funcionarios.php';</script>";
    }

?>