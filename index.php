<!DOCTYPE html>
<html lang='PT-BR'>
<head>
    <?php
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
    $logado = $_SESSION['login'];
    ?> */
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SISTEMA WEB</title>
</head>
<body>
bem vindo! <?php $login ?>
</body>
</html>