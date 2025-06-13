<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (in_array($email, $_SESSION['emailTrabalhador'])){
            echo "<script>alert('Este e-mail já está cadastrado, tente novamente!');</script>";
            echo "<script>window.location.href='funcionarios.php';</script>";
            exit();
        }
        $diretorio = 'dadosUserjson/';
        array_push($_SESSION['nomeTrabalhador'], $nome);
        array_push($_SESSION['emailTrabalhador'], $email);
        array_push($_SESSION['senhaTrabalhador'], $senha);
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'emailUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
        $diretorio = 'jsons/';
        file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
        header("Location: funcionarios.php");
    }