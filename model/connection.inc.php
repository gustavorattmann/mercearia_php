<?php

    require_once '../config.php';

    $connect = mysqli_connect(HOST.':'.PORT,USER,PASSWORD,DATABASE) or die("Erro: ".mysqli_errno()." = ".mysqli_error());

?>