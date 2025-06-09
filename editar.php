<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ;
        $qtProdu = $_POST['qtPro'] ;
        $nome = $_POST['nome'] ;
        $prejuizo = $_POST['preju'];
        $id = $_POST['id'] ?? '';
        $_SESSION['nomesUser'][$id] = $nome;
        $_SESSION['emailUser'][$id] = $email;
        $_SESSION['quantidades'][$id] = $qtProdu;
        $_SESSION['prejuizos'][$id] = $prejuizo;
        echo "<script>alert('Trabalhador editado com sucesso!');</script>";
        echo "<script>window.location.href='inicial.php';</script>";
    }

?>