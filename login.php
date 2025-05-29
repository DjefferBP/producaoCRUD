<?php
    session_start();
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $emails = json_decode(file_get_contents("jsons/email.json"), true);
    $senhas = json_decode(file_get_contents("jsons/senha.json"), true);
    $emailAdm = json_decode(file_get_contents("jsons/emailadm.json"), true);
    $senhaAdm = json_decode(file_get_contents("jsons/senhaadm.json", true));
    $indiceAdm = array_search($email, $emailAdm);
    $indice = array_search($email, $emails);
    if (($indice !== false && isset($senhas[$indice]) && $senha === $senhas[$indice])) {
        $_SESSION['usuario'] = $email;
        header("Location: inicial.php");
        exit;
    } elseif (($indiceAdm !== false && isset($senhaAdm[$indiceAdm]) && $senha === $senhaAdm[$indiceAdm])){
        $_SESSION['usuario'] = $email;
        header("Location: inicial.php");
        exit;
    }
     else {
        echo "<script>alert('Credenciais inválidas.Tente novamente, por favor!');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
?>