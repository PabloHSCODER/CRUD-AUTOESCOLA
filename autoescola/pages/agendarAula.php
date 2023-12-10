<?php
require_once "../connection.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Agendar Aula - AutoEscola</title>
</head>
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
        }
        body {
            background-image: url('../imagens/agendaaula.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
        }
        </style>
<body>
    <h1>AUTO ESCOLA EXPRESS</h1>
    <main class="container-lg min-vh-100 d-flex flex-column justify-content-center">
        <form action="../validadores/processaAgendamento.php<?php echo !empty($id) ? "?update=$id" : "";?>" method="POST" id="agendaAula" class="d-flex flex-column">
            <label for="alunos" class="">
                Aluno
                <select name="alunos" id="alunos" class="form-control">
                    <option value="">->SELECIONE UMA OPÇÃO<-</option>
                    <?php
                        $query = $PDO->query("SELECT * FROM alunos;");
                        $result = $query->fetchAll();

                        foreach($result as $aluno)
                        {
                            $nome = $aluno["nome"];
                            $id   = $aluno["id"];
                            echo "<option value='$id'>$nome</option>";
                        }
                    ?>
                </select>
            </label>
            <label for="carros">
                Carro
                <select name="carros" id="carros" class="form-control">
                    <option value="">->SELECIONE UMA OPÇÃO<-</option>
                    <?php
                        $query = $PDO->query("SELECT * FROM carros;");
                        $result = $query->fetchAll();

                        foreach($result as $carro)
                        {
                            $id   = $carro["id"];
                            echo "<option value='$id'>$id</option>";
                        }
                    ?>
                </select>
            </label>
            <label for="data">
                Data
                <input type="date" name="data" class="form-control" id="data" value="<?php echo $data ?>">
            </label>
            <label for="horario">
                Horário
                <input type="time" name="horario" class="form-control" id="horario" value="<?php echo $horario ?>">
            </label>
            <input type="submit" value="Agendar" id="agendarAula" disabled>
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
        const FORM_AGENDAR_AULA  = document.querySelector("#agendaAula");
        let confirmacaoCampos = {
            alunos: {
                verificado: false,
                elemento: document.querySelector("#alunos")
            },
            carros: {
                verificado: false,
                elemento: document.querySelector("#carros")
            },
            data: {
                verificado: false,
                elemento: document.querySelector("#data")
            },
            horario: {
                verificado: false,
                elemento: document.querySelector("#horario")
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

            const BTN_CADASTRAR_CARRO = document.querySelector("#agendarAula");
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

            if(camposVerificados == 4)
            {
                BTN_CADASTRAR_CARRO.removeAttribute("disabled");
            }
            else
            {
                BTN_CADASTRAR_CARRO.setAttribute("disabled", "");
            }
            console.log(camposVerificados);
        }
        FORM_AGENDAR_AULA.addEventListener("input", (e) => confirmaCampo(e.target));
    </script>
</body>
</html>