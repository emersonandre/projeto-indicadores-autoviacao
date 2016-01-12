<?php session_start();
// session_start inicia a sess�o session_start(); 
// as variáveis login e senha recebem os dados digitados na p�gina anterior

$login = $_POST['usuario'];
$senha = $_POST['senha'];

//variaveis de conexão;

$host = '192.168.0.5';
$usuario = 'master';
$senhabd = '9748670';
$banco = 'usuarios';

//resolve conexão com o banco!
$con = new mysqli($host, $usuario, $senhabd, $banco) or die ("Sem conexão com o servidor");

//retorna resultado da consulta TRUE ou FALSE
$result = mysqli_query($con,"SELECT * FROM usuarios WHERE `usuario` = '$login' AND `senha`= '$senha'");
// Verifica se o usuario logado esta ativo.
if(mysqli_num_rows ($result) > 0 ) { 
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    header('location:dashboard.php'); }
    else{
        unset ($_SESSION['login']); 
        unset ($_SESSION['senha']);
        header('location:index.php');
    }
?>