<?php
	include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
	protegePagina();
	echo "Bem Vindo ". $_SESSION['usuarioNome'];
?>
