<?php

// Conectando
require_once '../../Models/DBConnection.php';

$con = new DBConnection();
$res = $con->getConexao();

// Executando consulta SQL
//$query = 'SELECT * FROM montadora WHERE idmontadora =5';
//$resultado = $res->query($query)->fetchAll(PDO::FETCH_ASSOC);
//$json = json_encode($resultado, JSON_PRETTY_PRINT);
//echo "$json";

$url = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados/');
$estados = json_decode($url);

foreach ($estados as  $estado){
    echo "insert into estados (id, sigla, nome) values ('".$estado->id."','".$estado->sigla."','".$estado->nome."');<br>";
}