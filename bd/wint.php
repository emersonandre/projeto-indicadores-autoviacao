<?php
//metodo para se conectar usando versão 4 ou anterior do PHP
//depende da instalação do client do oracle e configuração do arquivo TNS

$ora_user = "IBRAS"; 
$ora_senha = "IBRAS2014546"; 

$ora_bd = "(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.0.158)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = ORCL)
    )
  )";

$conexao = oci_connect($ora_user, $ora_senha,$ora_bd);

if (!$conexao) { 
    echo "Erro na conexão com o Oracle.".oci_error();
}
/*

$sql = "select * from PCPEDIDO";

$std = oci_parse($ora_conexao, $sql);

$result = oci_execute($std);

while($row = oci_fetch_object($std)){
    echo $row->VLTOTAL."<br>";
}
 */