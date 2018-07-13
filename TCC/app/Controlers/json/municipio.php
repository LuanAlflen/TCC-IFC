<?php

// Conectando
require_once '../../Models/DBConnection.php';

$con = new DBConnection();
$res = $con->getConexao();

// Executando consulta SQL

//$query = 'SELECT * FROM modelo WHERE idmodelo =5';
//$resultado = $res->query($query)->fetchAll(PDO::FETCH_ASSOC);
//$json = json_encode($resultado, JSON_PRETTY_PRINT);
//echo "$json";

// Consulta SQL e Pesquisa na tabela FIPE para cada modelo em montadora

$query = 'SELECT id_estado FROM estados ';
$resultado = $res->query($query)->fetchAll(PDO::FETCH_ASSOC);
//print_r($resultado);

foreach ($resultado as $rst) {
    //echo 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$rst['id_estado'].'/muncipios';
    $url = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$rst['id_estado'].'/municipios');

    $municipios = json_decode($url);

    foreach ($municipios as  $municipio){
        echo "insert into municipios (id_municipio, nome, id_estado) values ('".$municipio->id."', '".$municipio->nome."', ".$rst['id_estado'].");<br>";
    }


}

// Consulta PHP e criação de pastas para cada marca

//$query = 'SELECT montadora FROM montadora';
//$resultado = $res->query($query)->fetchAll(PDO::FETCH_ASSOC);
//print_r($resultado);
//foreach ($resultado as $rst) {

//}
//NOSSO BANCO TEM 5545 MUNICIPIOS, DEVERIA TER 5571, EU PROVAVELMENTE PERDI ALGUNS DO PARANA OU DE SAO PAULO, BOA SORTE BRYAN, QUE OS JOGOS COMECEM