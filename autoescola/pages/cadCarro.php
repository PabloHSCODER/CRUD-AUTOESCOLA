<?php
include_once "../connection.php";

$id         = "";
$marca      = "";
$modelo     = "";
$ano        = "";
$placa      = "";
$capacidade = "";

if(isset($_GET["edit"]))
{
    $id         = intval($_GET["edit"]);
    
    $query      = $PDO->query("SELECT * FROM carros");
    $result     = $query->fetch();

    $marca      = $result["marca"];
    $modelo     = $result["modelo"];
    $ano        = $result["ano"];
    $placa      = $result["placa"];
    $capacidade = $result["capacidade_passageiros"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/default.css">
    <title>Cadastro Carro - AutoEscola</title>
    <style>
        
        h1 {

            text-align: center;
            color:red;
            font-family: Arial, sans-serif;
            font-size: 50px;
        }

        label{
            color:red;
            font-weight: bold;
            font-size: 20px;
            background-color: black;
            
        }
        body {
            background-image: url('../imagens/carro.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
        }
        </style>
    </style>
  
</head>
<body>
    <h1>AUTO ESCOLA EXPRESS</h1>
    <main class="container-lg min-vh-100 d-flex flex-column justify-content-center">
        <form action="../validadores/processaCarro.php<?php echo !empty($id) ? "?update=$id" : "";?>" method="POST" id="cadCarro">
            <div>
                <label for="marca" class="w-100">
                    Marca
                    <input type="text" name="marca" class="form-control" id="marca"value="<?php echo $marca ?>"/>
                    <input type="hidden" name="id" class="form-control" id="id" class="w-100" value="<?php echo $id ?>"/>
                </label>
            </div>
            <div class="">
                <label for="modelo" class="w-100">
                    Modelo
                    <input type="text" name="modelo" class="form-control" id="modelo" value="<?php echo $modelo ?>"/>
                </label>
            </div>
            <div class="">
                <label for="ano" class="w-100">
                    Ano
                    <input type="text" name="ano" class="form-control" id="ano" value="<?php echo $ano ?>"/>
                </label>
            </div>
            <div class="">
                <label for="placa" class="w-100">
                    Placa
                    <input type="text" name="placa" class="form-control" id="placa" value="<?php echo $placa ?>"/>
                </label>
            </div>
            <div class="">
                <label for="capacidade" class="w-100">
                    Capacidade
                    <input type="number" name="capacidade" class="form-control" id="capacidade" value="<?php echo $capacidade ?>"/>
                </label>
            </div>
            <div class="">
                <input type="submit" value="Cadastrar" id="cadastrarCarro" disabled/>
            </div>
        </form>
    </main>
    <script>
        const FORM_CAD_CARRO = document.querySelector("#cadCarro");
        let confirmacaoCampos = {
            marca: {
                verificado: false,
                elemento: document.querySelector("#marca")
            },
            modelo: {
                verificado: false,
                elemento: document.querySelector("#modelo")
            },
            ano: {
                verificado: false,
                elemento: document.querySelector("#ano")
            },
            placa: {
                verificado: false,
                elemento: document.querySelector("#placa")
            },
            capacidade: {
                verificado: false,
                elemento: document.querySelector("#capacidade")
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

            const BTN_CADASTRAR_CARRO = document.querySelector("#cadastrarCarro");
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