<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_POST['editarMeta'])) {
        $meta = floatval($_POST['editarMeta']);
        $_SESSION['meta'][0] = $meta;
        file_put_contents("meta.json", json_encode([ $meta ], JSON_PRETTY_PRINT));
        header("Location: ../inicial.php");
        exit;
    }
    if (count($_SESSION["meta"]) <= 0) {
        echo "<h4 style='font-size: 18px'><b>Meta não definida</b></h4>";
    } else {
        echo "<h4 style='font-size: 18px'><b>Meta: </b>" . $_SESSION["meta"][0] . "</h4>";
    }