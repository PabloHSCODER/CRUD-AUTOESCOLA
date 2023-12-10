<?php
require_once "../connection.php";

$redirect = "../index.php";

if(!empty($_POST))
{
    $id              = $_POST["id"]; 
    $nome            = $_POST["nome"];
    $cpf             = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $endereco        = $_POST["endereco"];
    $telefone        = $_POST["telefone"];
}

function validaCPF($cpf) 
{
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}
function validarTelefone($phone)
{
    $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

    if (preg_match($regex, $phone) == false) {

        // O número não foi validado.
        return false;
    } else {

        // Telefone válido.
        return true;
    }        
}

if(!validaCPF($cpf))
{
    $redirect = isset($_GET["update"]) ? "../pages/cadAluno.php?erro=1&edit=$id" : "../pages/cadAluno.php?erro=1";
}
else if(!validarTelefone($telefone))
{
    $redirect = isset($_GET["update"]) ? "../pages/cadAluno.php?erro=2&edit=$id" : "../pages/cadAluno.php?erro=2";
}
else if(!isset($_GET["update"])){
    session_start();

    $query = $PDO->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'alunos' AND table_schema = 'autoescola' ;");
    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION["id"] = $result["AUTO_INCREMENT"];

    $PDO->query("INSERT INTO alunos(nome, cpf, data_nascimento, endereco, telefone) VALUES('$nome', '$cpf', '$data_nascimento', '$endereco', '$telefone')");

}
else{
    $PDO->query("UPDATE alunos SET nome = '$nome', cpf = '$cpf', data_nascimento = '$data_nascimento', endereco = '$endereco', telefone = '$telefone' WHERE id = $id");
    $redirect = ("../index.php?success=2");
}

header("Location: $redirect");