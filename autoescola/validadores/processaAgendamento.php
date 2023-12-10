<?php
require_once "../connection.php";

$idAluno = $_POST["alunos"];
$idCarro  = $_POST["carros"];
$data     = $_POST["data"];
$horario  = $_POST["horario"];

$PDO->query("INSERT INTO agendamentos(aluno_id, carro_id, data_aula, horario_aula) VALUES($idAluno, $idCarro, '$data', '$horario');");
header("Location: ../index.php");