<?php

session_start();

include('configURL.php');

if (($_SESSION['cd_usuario'] == null ) && ($_SESSION['nm_usuario'] == null )){
    $tipo_msg = 2;
    $desc_msg = 'Sua Sessaõ Expirou';

    header('Location: index.php?tipo_msg='.$tipo_msg.'&desc_msg='.$desc_msg);
}
