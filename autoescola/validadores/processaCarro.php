<?php
require_once "../connection.php";

$id         = $_POST["id"];
$marca      = $_POST["marca"];
$modelo     = $_POST["modelo"];
$ano        = $_POST["ano"];
$placa      = $_POST["placa"];
$capacidade = $_POST["capacidade"];

if(!isset($_GET["update"]))
{  
    $PDO->query("INSERT INTO carros(marca, modelo, ano, placa, capacidade_passageiros) VALUES('$marca', '$modelo', $ano, '$placa', $capacidade)");
    header("Location: ../index.php");
}
else
{
    $PDO->query("UPDATE carros SET marca = '$marca', modelo = '$modelo', ano = $ano, placa = '$placa', capacidade_passageiros = $capacidade WHERE id = $id");
    header("Location: ../index.php?success=2");
}



