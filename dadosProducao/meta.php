<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_POST['editarMeta'])) {
        $meta = floatval($_POST['editarMeta']);
        file_put_contents("meta.json", json_encode([ $meta ], JSON_PRETTY_PRINT));
        unset($_SESSION['meta']);
        header("Location: ../inicial.php");
        exit;
    }

    if (file_exists("meta.json")) {
        $metaArray = json_decode(file_get_contents("meta.json"), true);
        $meta = isset($metaArray[0]) ? floatval($metaArray[0]) : 0;
        echo "<h4 style='font-size: 18px'><b>Meta: $meta</b>)</h4>";
    } else {
        echo "<h4 style='font-size: 14px'><b>Não há uma meta estipulada!</b></h4>";
    }