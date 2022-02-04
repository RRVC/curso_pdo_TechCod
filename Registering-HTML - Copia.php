<?php

require_once 'Registering-SQL.php';

$p = new RegisteringSQL("crudpdo", "localhost", "root", "");

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registering HTML</title>
    <link rel="stylesheet" href="/curso_pdo_TechCod/css/styles.css">

</head>

<body>
    <?php

    if (isset($_POST['name_input'])) {
        $nome = addslashes($_POST['name_input']);
        $telefone = addslashes($_POST['tel_input']);
        $email = addslashes($_POST['email_input']);
        if (!empty($nome) && !empty($telefone) && !empty($email)) {
            if(!$p->insert($nome, $telefone, $email)){
                echo "Email já cadastrado!";
            };
        } else {
            echo "Preencha todos os campos!";
        }
    }

    if (isset($_GET['id'])){
        $p->delete($_GET['id']);
        header("Location: Registering-HTML.php");
    }

    ?>


    <h1>Cadastramento</h1>
    <form id="all" method="POST">
        <div id="all_inputs_container">
            <h1>Dados</h1>

            <div id="rng_container">
                <input class="input_btn" type="button" value="SET RNG" onclick="set_rng()">
                <input class="input_btn" type="button" value="UNSET" onclick="unset_fields()">
            </div>

            <!--
            <div class="input_container" id="user_category">
                <span>Você é aluno?:</span>
                <div id="radio_buttons">
                    <label for="sim">
                        <input type="radio" id="sim" name="user_category" value=1"> Sim
                    </label>
                    <label for="não">
                        <input type="radio" id="não" name="user_category" value="2"> Não
                    </label>
                </div>
            </div>
            -->
            <div class="input_container" id="name_container">
                <span>Nome: </span>
                <input type="text" class="input_field" name="name_input" id="name_input" placeholder="Digite seu nome" maxlength="30" autofocus>
            </div>
            <div class="input_container" id="tel_container">
                <span>Telefone: </span>
                <input type="text" class="input_field" name="tel_input" id="tel_input" placeholder="Digite seu telefone" maxlength="12">
            </div>
            <div class="input_container" id="email_container">
                <span>Email: </span>
                <input type="email" class="input_field" name="email_input" id="email_input" placeholder="Digite seu email">
            </div>
            <!--
            <div class="input_container" id="grade_container">
                <span>Nota: </span>
                <input type="text" class="input_field" name="grade_input" id="grade_input" maxlength="3" style="width: 50px;">
            </div>
            -->
            <div class="btn_container">
                <input class="input_btn" type="submit" value="Cadastrar" onclick="signUp()">
            </div>
            <div class="error_msg">
                <span class="out_msg"></span>
            </div>
        </div>
        <div id="all_outputs_container">

            <!--
            <div class="registry_container" id="students_container">
                <h1>Alunos</h1>
                <div class="list_container">
                </div>
                <div class="btn_container">
                    <input class="input_btn" type="button" onclick="reg_clear(0)" value="Limpar registro">
                </div>
            </div>
            -->

            <div class="registry_container" id="users_container">
                <h1>Cadastros</h1>
                <div class="list_container">
                    <?php
                    $dados = $p->buscarDados();
                    if (count($dados) > 0) {
                        for ($i = 0; $i < count($dados); $i++) {
                            ?>
                            <div class='user_container' id='<?=$dados[$i]['id']?>'>
                            <?php

                            foreach ($dados[$i] as $key => $value) {
                                if ($key != "id") {
                                    echo $key .": " . $value . "<br>";
                                }
                            }
                            ?>
                                <div class='btn_container'>
                                    <a class='input_btn' href="">Editar</a>
                                    <a class='input_btn' href="Registering-HTML.php?id=<?=$dados[$i]['id']?>">Excluir</a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<h1>Registro vazio!</h1>";
                    }
                    ?>
                </div>
                <div class="btn_container">
                    <input class="input_btn" type="button" onclick="reg_clear(1)" value="Limpar registro">
                </div>
            </div>
        </div>
    </form>

    <script src="/curso_pdo_TechCod/js/scripts.js"> </script>
    <footer>
        <a class="input_btn" href="Registering-HTML.php">Atualizar</a>
        <p>&copy; RRVTI</p>
    </footer>
</body>

</html>