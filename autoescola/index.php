<?php
include "connection.php";
include "success.php";

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ./pages/cadAluno.php");
}
if(isset($_GET["delete"]))
{
    $table = $_GET["table"];
    $id    = $_GET["delete"];
    $PDO->query("DELETE FROM $table WHERE id = $id");
    header("Location: index.php");
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="./styles/default.css">
        <title>
            EXPRESS - AUTO ESCOLA
        </title>
        <style>
        h1 {
            text-align: center;
            color:red;
            font-family: Arial, sans-serif;
            font-size: 50px;
        }
        h2{
            color:red;
        }
        body {
            background-image: url('imagens/estrada.jpg'); /* Substitua pelo caminho da sua imagem */
            background-size: cover; /* Ajusta o tamanho da imagem para cobrir todo o fundo */
            background-repeat: no-repeat; /* Evita repetição da imagem */
        }
        </style>
    </head>

    <body>
        <main class="container-lg min-vh-100 d-flex flex-column justify-content-center">
            
        <h1>AUTO ESCOLA EXPRESS</h1>
            <h2>Carros</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            ID CARRO
                        </th>
                        <th>
                            Marca
                        </th>
                        <th>
                            Modelo
                        </th>
                        <th>
                            Ano
                        </th>
                        <th>
                            Placa
                        </th>
                        <th>
                            Capacidade
                        </th>
                        <th>
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="8">
                            <button class="btn btn-dark">
                                <a href="./pages/cadCarro.php" class="text-decoration-none text-uppercase">
                                    <i class="bi-plus"></i>
                                    Adicionar
                                </a>
                            </button>
                        </th>
                    </tr>
                    <?php
                        $query  = $PDO->query("SELECT * FROM carros;");
                        $result = $query->fetchAll();

                        foreach ($result as $carro) {
                            $id         = $carro["id"];
                            $marca      = $carro["marca"];
                            $modelo     = $carro["modelo"];
                            $ano        = $carro["ano"];
                            $placa      = $carro["placa"];
                            $capacidade = $carro["capacidade_passageiros"];

                            echo "
                                <tr>
                                    <th>
                                        $id
                                    </th>
                                    <th>
                                        $marca
                                    </th>
                                    <th>
                                        $modelo
                                    </th>
                                    <th>
                                        $ano
                                    </th>
                                    <th>
                                        $placa
                                    </th>
                                    <th>
                                        $capacidade
                                    </th>
                                    <th>
                                        <a href='./pages/cadCarro.php?edit=$id' class='bi'><i class='bi bi-pencil-fill'></i></a>
                                    </th>
                                    <th>
                                        <a href='index.php?delete=$id&table=carros'><i class='bi bi-trash3-fill'></i></a>
                                    </th>
                                <tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Alunos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            ID ALUNO
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            CPF
                        </th>
                        <th>
                            Data Nascimento
                        </th>
                        <th>
                            Endereço
                        </th>
                        <th>
                            Telefone
                        </th>
                        <th>

                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="8">
                            <button class="btn btn-dark">
                                <a href="./pages/cadAluno.php" class="text-decoration-none text-uppercase">
                                    <i class="bi-plus"></i>
                                    Adicionar
                                </a>
                            </button>
                        </th>
                    </tr>
                    <?php
                        $query  = $PDO->query("SELECT * FROM alunos;");
                        $result = $query->fetchAll();
                        
                        foreach ($result as $aluno) {
                            $id              = $aluno["id"];
                            $nome            = $aluno["nome"];
                            $cpf             = $aluno["cpf"];
                            $data_nascimento = $aluno["data_nascimento"];
                            $endereco        = $aluno["endereco"];
                            $telefone        = $aluno["telefone"];

                            echo "
                                <tr>
                                    <th>
                                        $id
                                    </th>
                                    <th>
                                        $nome
                                    </th>
                                    <th>
                                        $cpf
                                    </th>
                                    <th>
                                        $data_nascimento
                                    </th>
                                    <th>
                                        $endereco
                                    </th>
                                    <th>
                                        $telefone
                                    </th>
                                    <th>
                                        <a href='./pages/cadAluno.php?edit=$id' class='bi'><i class='bi bi-pencil-fill'></i></a>
                                    </th>
                                    <th>
                                        <a href='index.php?delete=$id&table=alunos'><i class='bi bi-trash3-fill'></i></a>
                                    </th>
                                <tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Aulas Agendadas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            ID ALUNO
                        </th>
                        <th>
                            Aluno
                        </th>
                        <th>
                            Carro
                        </th>
                        <th>
                            Data
                        </th>
                        <th>
                            Horário
                        </th>
                        <th>
                        </th>
                        <th>
                    
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="8">
                            <button class="btn btn-dark">
                                <a href="./pages/agendarAula.php" class="text-decoration-none text-uppercase">
                                    <i class="bi-plus"></i>
                                    Agendar
                                </a>
                            </button>
                        </th>
                    </tr>
                    <?php
                        $query  = $PDO->query("SELECT * FROM agendamentos;");
                        $result = $query->fetchAll();
                        
                        foreach ($result as $agendamento) {
                            $id           = $agendamento["id"];
                            $aluno_id     = $agendamento["aluno_id"];
                            $carro_id     = $agendamento["carro_id"];
                            $data_aula    = $agendamento["data_aula"];
                            $horario_aula = $agendamento["horario_aula"];

                            echo "
                                <tr>
                                    <th>
                                        $id
                                    </th>
                                    <th>
                                        $aluno_id
                                    </th>
                                    <th>
                                        $carro_id
                                    </th>
                                    <th>
                                        $data_aula
                                    </th>
                                    <th>
                                        $horario_aula
                                    </th>
                                    <th colspan='2'>
                                        <a href='index.php?delete=$id&table=agendamentos'><i class='bi bi-trash3-fill'></i></a>
                                    </th>
                                <tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
            <?php
                if(isset($_GET["success"]))
                {
                    echo $mensagensSucesso[$_GET["success"]];
                }
            ?>
        </main>
    </body>
</html>


