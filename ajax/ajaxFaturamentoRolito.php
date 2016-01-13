<?php

/*
 * Autores: Jonas, Emersom.
 * Colaboração: Jonny. 
 * Data Criação:13/01/2016
 * Obs: Esta arquivo tem por objetivo buscar dados de faturamento no banco de dados do Rolito e tratar separadamento o mês atual +
 * os ultimos 11 meses e retornar em um gráfico de linha
 */


//funcao consulta datas
function retornaTotal($mes,$ano){
    include '../bd/wint.php';
    
    //select que recebe parametros da funcao
    $sql = "SELECT 
                SUM(VLTOTAL) AS TOTAL
            FROM 
                PCNFSAID
            WHERE 
                CODFILIAL='3' AND
                OBS IS NULL AND
                EXTRACT(MONTH FROM dtsaida) = '$mes' AND
                EXTRACT(YEAR FROM dtsaida) = '$ano'";
    
    
    //declaracao variaveis
    $faturamento = 0;
    
    //executa sql
    $std = oci_parse($conexao,$sql);
    oci_execute($std);
    while($row = oci_fetch_object($std)){
        $faturamento = $row->TOTAL;
    }
    
    //fecha conexao
    oci_close($conexao);
    
    //retarna valores
    return $faturamento;
}



//pegar data atual
$mesAtual = date('m');//recebe mes atual
$anoAtual = date('Y');//recebe ano atual
$retorno;

//declara variavel for;
$contFat = 0;

//inicia for

for($mes=1;$mes < 13; $mes++){
        
    //se mes igual a 0 volta pra 12
    if($mesAtual == 0){
        $mesAtual= 12;
        $anoAtual = $anoAtual - 1;
    }
       
    $retorno[$contFat] = retornaTotal($mesAtual,$anoAtual);
    $mesAtual = $mesAtual - 1;
    $contFat++;
}

echo json_encode($retorno);