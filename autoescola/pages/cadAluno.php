<?php 
    include "../erros.php";
    include_once "../connection.php";

    $id              = "";
    $nome            = "";
    $cpf             = "";
    $data_nascimento = "";
    $endereco        = "";
    $telefone        = "";

    if(isset($_GET["edit"]))
    {
        $id              = $_GET["edit"];
        $query           = $PDO->query("SELECT * FROM alunos WHERE id = $id");
        $result          = $query->fetch(PDO::FETCH_ASSOC);

        $nome            = $result["nome"];
        $cpf             = $result["cpf"];
        $data_nascimento = $result["data_nascimento"];
        $endereco        = $result["endereco"];
        $telefone        = $result["telefone"];
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./styles/default.css">
    <title>Cadastro Aluno - AutoEscola</title>
    <style>
        h1 {

            text-align: center;
            color:red;
            font-family: Arial, sans-serif;
            font-size: 50px;
            margin-top: 100px;
        }
        label{
            color:red;
            background-color: white;
            border-radius: 10px;
        }
        body {
            background-image: url('../imagens/aluno.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
        }
        </style>
</head>
<body>
    <h1>AUTO ESCOLA EXPRESS</h1>
    <main class="container-lg min-vh-100 d-flex flex-column justify-content-center">
        <form action="../validadores/processaAluno.php<?php echo !empty($id) ? "?update=$id" : "";?>" method="POST" id="cadAluno">
            <label for="nome" class="w-100">
                Nome
                <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $nome ?>">
                <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $id ?>">
            </label>
            <label for="cpf" class="w-100">
                CPF
                <input type="text" name="cpf" class="form-control" id="cpf" value="<?php echo $cpf ?>">
            </label>
            <label for="dt_nasc" class="w-100">
                Data de Nascimento
                <input type="date" name="data_nascimento" class="form-control" id="dt_nasc" value="<?php echo $data_nascimento ?>">
            </label>
            <label for="endereco" class="w-100">
                Endereço
                <input type="text" name="endereco" class="form-control" id="endereco" value="<?php echo $endereco ?>">
            </label>
            <label for="telefone" class="w-100">
                Telefone
                <input type="tel" name="telefone" class="form-control" id="telefone" value="<?php echo $telefone ?>">
            </label>
            <input type="submit" value="Cadastrar" id="cadastrarAluno" disabled>
        </form>
       
        <?php 
            
            if(isset($_GET["erro"]))
            {
                $mensagem = $mensagensErro[$_GET["erro"]];
                echo "
                    <div class='alert alert-warning'>
                        $mensagem
                    </div>
                ";
            }
        ?>

    </main>
    <script>
        //selecionando o formulario e os dados contidos nele
        const FORM_CAD_CARRO  = document.querySelector("#cadAluno");
        let confirmacaoCampos = {
            nome: {
                verificado: false,
                elemento: document.querySelector("#nome")
            },
            cpf: {
                verificado: false,
                elemento: document.querySelector("#cpf")
            },
            dt_nasc: {
                verificado: false,
                elemento: document.querySelector("#dt_nasc")
            },
            endereco: {
                verificado: false,
                elemento: document.querySelector("#endereco")
            },
            telefone: {
                verificado: false,
                elemento: document.querySelector("#telefone")
            }
        };

        function confirmaCampo(campo)
        {
            for(let campo in confirmacaoCampos)
            {
                if(confirmacaoCampos[campo].elemento.value.length >= 1)
                {
                    confirmacaoCampos[campo].verificado = true;
                }
            }

            const BTN_CADASTRAR_CARRO = document.querySelector("#cadastrarAluno");
            let camposVerificados = 0;

            if(campo.value.length >= 1)
            {
                confirmacaoCampos[campo.id].verificado = true;
            }
            else{
                confirmacaoCampos[campo.id].verificado = false;
            }

            for(let campo in confirmacaoCampos)
            {
                if(confirmacaoCampos[campo].verificado == true)
                {
                    camposVerificados++;
                }
            }

            if(camposVerificados == 5)
            {
                BTN_CADASTRAR_CARRO.removeAttribute("disabled");
            }
            else
            {
                BTN_CADASTRAR_CARRO.setAttribute("disabled", "");
            }
            console.log(camposVerificados);
        }
        FORM_CAD_CARRO.addEventListener("input", (e) => confirmaCampo(e.target));
    </script>
</body>
</html>