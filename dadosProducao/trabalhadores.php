<?php 
    $trabalhadores = json_decode(file_get_contents("jsons/email.json") , true);
    $cont = count( $trabalhadores );
    echo "<h4 style='font-size: 16px'><b>$cont</b></h4>";