<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ;
        $qtProdu = $_POST['qtPro'] ;
        $nome = $_POST['nome'] ;
        $prejuizo = $_POST['preju'];
        $id = $_POST['id'] ?? '';
        $_SESSION['nomesUser'][$id] = $nome;
        $_SESSION['nomeTrabalhador'][$id] = $nome;
        $_SESSION['emailUser'][$id] = $email;
        $_SESSION['emailTrabalhador'][$id] = $email;
        $_SESSION['quantidades'][$id] = $qtProdu;
        $_SESSION['prejuizos'][$id] = $prejuizo;
        $_SESSION['senhaTrabalhador'][$id] = $_POST['senha'] ?? $_SESSION['senhaTrabalhador'][$id];
        $diretorio = 'dadosUserjson/';
        file_put_contents($diretorio . 'quantidades.json', json_encode($_SESSION['quantidades'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'prejuizos.json', json_encode($_SESSION['prejuizos'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'emailsUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
        $diretorio = 'jsons/';
        file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
        echo "<script>alert('Trabalhador editado com sucesso!');</script>";
        echo "<script>window.location.href='funcionarios.php';</script>";
    }

?>