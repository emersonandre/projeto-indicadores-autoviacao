<?php

/*
 * Autores: Jonas, Emersom.
 * Colaboração: Jonny. 
 * Data Criação:13/01/2016
 * Obs: este arquivo tem por objetivo retornar uma tabela dinamica de dados! sobre faturamento vs medias dos clientes
 * 
 */

//pegar data atual
$diaAtual = date('d');//recebe dia atual
$mesAtual = date('m');//recebe mes atual
$anoAtual = date('Y');//recebe ano atual
//
$ultimo_dia = date("t", mktime(0,0,0,$mesAtual,'01',$anoAtual)); // Mágica, plim!

//
//variavel para calcular media;
$media_mesini=$mesAtual;
$media_mesfim=$mesAtual;
$media_anoini=$anoAtual;
$media_anofim=$anoAtual;

//variavel para calcular mes anterior;
$mes_anterior=$mesAtual;
$ano_anteriro=$anoAtual;

//inicio calculos mes anterior;
for($mes=1;$mes < 2; $mes++){    
    $mes_anterior = $mes_anterior - 1;
    //se mes igual a 0 volta pra 12
    if($mes_anterior == 0){
        $mes_anterior= 12;
        $ano_anteriro = $ano_anteriro - 1;
    }    
}

//inicio calculo meses media inicial;
for($mes=1;$mes < 6; $mes++){    
    $media_mesini = $media_mesini - 1;
    //se mes igual a 0 volta pra 12
    if($media_mesini == 0){
        $media_mesini= 12;
        $media_anoini = $media_anoini - 1;
    }    
}

//inicio calculo meses media final;
for($mes=1;$mes < 3; $mes++){    
    $media_mesfim = $media_mesfim - 1;
    //se mes igual a 0 volta pra 12
    if($media_mesfim == 0){
        $media_mesfim= 12;
        $media_anofim = $media_anofim - 1;
    }    
}


//consulta datas;  
include '../bd/wint.php';

    //select que recebe os parametros da funcao
    $sql="SELECT 
                P.CODCLI
                ,M.CLI
                ,cast(((SUM(P.VLTOTAL)/'$diaAtual')*'$ultimo_dia') as NUMERIC(15,2)) AS tendencia
                ,SUM(P.VLTOTAL) AS MESATUAL
                ,M.ANT AS ULTMES
                ,M.DOZE AS MEDIA 
            FROM 
                PCNFSAID P
                ,(
                  SELECT 
                      SUM(T.VLTOTAL) AS ANT
                      ,T.CODCLI
                      ,D.TOTALDOZE AS DOZE
                      ,D.CLIENTE AS CLI
                  FROM PCNFSAID T
                        ,(
                          SELECT 
                            cast(SUM(N.VLTOTAL/3) AS NUMERIC(15,3)) AS TOTALDOZE
                            ,N.CODCLI
                            ,Q.CLIENTE AS CLIENTE
                          FROM 
                            PCNFSAID N
                            ,PCCLIENT Q
                          WHERE  
                            N.CODFILIAL = 3 
                            AND EXTRACT(MONTH FROM N.DTSAIDA) >= '$media_mesini'--pega calculo media mes;
                            AND EXTRACT(YEAR FROM N.DTSAIDA) >= '$media_anoini'
                            AND EXTRACT(MONTH FROM N.DTSAIDA) <= '$media_mesfim'--pega calculo media ano;
                            AND EXTRACT(YEAR FROM N.DTSAIDA) <='$media_anofim'
                            AND N.OBS IS NULL 
                            AND N.DTDEVOL IS NULL
                            AND Q.CODCLI(+)= N.CODCLI 
                          GROUP BY 
                            N.CODCLI 
                            ,Q.CLIENTE
                        )D
                  WHERE 
                      T.CODFILIAL = 3 
                      AND EXTRACT(MONTH FROM T.DTSAIDA) = '$mes_anterior'       --pega calculo mes anterior;
                      AND EXTRACT(YEAR FROM T.DTSAIDA) = '$ano_anteriro'        --pega calculo ano do mes anterior;
                      AND T.OBS IS NULL 
                      AND T.DTDEVOL IS NULL
                      AND D.CODCLI(+)= T.CODCLI
                    GROUP BY 
                      T.CODCLI
                      ,D.TOTALDOZE
                      ,D.CLIENTE
                )M
            WHERE
                P.CODFILIAL = 3
                AND EXTRACT(MONTH FROM P.DTSAIDA) = '$mesAtual'                 --pega calculo mes atual;
                AND EXTRACT(YEAR FROM P.DTSAIDA) = '$anoAtual'                  --pega calculo ano atual;
                AND P.CODCLI(+)= M.CODCLI
                AND P.OBS IS NULL
                AND P.DTDEVOL IS NULL
                AND M.CLI IS NOT NULL

            GROUP BY 
                P.CODCLI
                ,M.ANT
                ,M.DOZE
                ,M.CLI

            ORDER BY 
                M.DOZE DESC";
           //declaracao variaveis
            
            $tabela = "<table id='tbldinamica' class='table table-bordered table-hover table-striped' >
                        <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>CLIENTE</th>
                                <th>TENDENCIA</th>
                                <th>MES ATUAL</th>
                                <th>MES ANTERIOR</th>
                                <th>MEDIA COMPRAS</th>
                            </tr>
                        </thead>
                        <tbody>
                      ";

            //executa sql
            $std = oci_parse($conexao,$sql);
            oci_execute($std);
            while($row = oci_fetch_object($std)){
                $tabela .= "<tr>";
                $tabela .= "<td>".str_pad($row->CODCLI,7, "0", STR_PAD_LEFT)."</td>";
                $tabela .= "<td>".utf8_encode($row->CLI)."</td>";
                $tabela .= "<td>R$ ".number_format($row->TENDENCIA,2,",",".")."</td>";
                $tabela .= "<td>R$ ".number_format($row->MESATUAL,2,",",".")."</td>";
                $tabela .= "<td>R$ ".number_format($row->ULTMES,2,",",".")."</td>";
                $tabela .= "<td>R$ ".number_format($row->MEDIA,2,",",".")."</td>";
                $tabela .= "</tr>";
            }

            $tabela .= "</tbody></table>";
            //fecha conexao
            oci_close($conexao);

            //retarna valores
            echo $tabela;
