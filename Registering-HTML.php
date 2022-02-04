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

    $out_msg = '';

    # ------------------------------------- UPDATE -------------------------------------;
    if (isset($_POST['name_input'])) {
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            $id_up = $_GET['id_up'];
            $newNome = addslashes($_POST['name_input']);
            $newTelefone = addslashes($_POST['tel_input']);
            $newEmail = addslashes($_POST['email_input']);
            if (!empty($newNome) && !empty($newTelefone) && !empty($newEmail)) {
                $p->update($id_up, $newNome, $newTelefone, $newEmail);
                $out_msg = '';
                header("Location: Registering-HTML.php");
            } else {
                $out_msg = "Preecha todos os campos";
            }
            # ------------------------------------- REGISTER -------------------------------------;
        } else {
            $nome = addslashes($_POST['name_input']);
            $telefone = addslashes($_POST['tel_input']);
            $email = addslashes($_POST['email_input']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) {
                if (!$p->insert($nome, $telefone, $email)) {
                    $out_msg = "Email já cadastrado";
                };
            } else {
                $out_msg = "Preecha todos os campos";
            }
        }
    }
    # ------------------------------------- READ -------------------------------------;
    if (isset($_GET['id_up'])) {
        $id_up = addslashes($_GET['id_up']);
        $res = $p->getData($id_up);
    }

    # ------------------------------------- DELETE -------------------------------------;
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
            <div class="input_container" id="name_container">
                <span>Nome: </span>
                <input type="text" value="<?php if(isset($res)){echo $res['nome'];}?>" class="input_field" name="name_input" id="name_input" placeholder="Digite seu nome" maxlength="30" autofocus>
            </div>
            <div class="input_container" id="tel_container">
                <span>Telefone: </span>
                <input type="text" value="<?php if(isset($res)){echo $res['telefone'];}?>"class="input_field" name="tel_input" id="tel_input" placeholder="Digite seu telefone" maxlength="12">
            </div>
            <div class="input_container" id="email_container">
                <span>Email: </span>
                <input type="email" value="<?php if(isset($res)){echo $res['email'];}?>"class="input_field" name="email_input" id="email_input" placeholder="Digite seu email">
            </div>
            <div class="btn_container">
                <input class="input_btn" type="submit" value="<?php if(isset($res)){echo 'Atualizar';}else{echo 'Cadastrar';}?>">
            </div>
            <div class="error_msg">
                <span class="out_msg"><?=$out_msg?></span>
            </div>
        </div>
        <div id="all_outputs_container">
            <div class="registry_container" id="users_container">
                <h1>Cadastros</h1>
                <div class="list_container">
                    <table>
                        <tr id="tr_title">
                            <td>Nome</td>
                            <td>Telefone</td>
                            <td colspan="2">Email</td>
                        </tr>
                    <?php
                    $dados = $p->buscarDados();
                    if (count($dados) > 0) {
                        for ($i = 0; $i < count($dados); $i++) {
                            ?>
                            <tr class='user_container' id='<?=$dados[$i]['id']?>'>
                            <?php

                            foreach ($dados[$i] as $key => $value) {
                                if ($key != "id") {
                                    echo "<td>" . $value . "</td>";
                                }
                            }
                            ?>
                            <td>
                                <div class='btn_container'>
                                    <a class='input_btn' href="Registering-HTML.php?id_up=<?=$dados[$i]['id']?>">Editar</a>
                                    <a class='input_btn' href="Registering-HTML.php?id=<?=$dados[$i]['id']?>">Excluir</a>
                                </div>
                            </td>
                            <?php
                        }
                        echo "</tr>";
                        echo "</table>";
                    } else {
                        echo "</table>";
                        echo "<h1>Registro vazio!</h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>

    <script src="/curso_pdo_TechCod/js/scripts.js"> </script>
    <footer>
        <a class="input_btn" href="Registering-HTML.php">Atualizar Página</a>
        <p>&copy; RRVTI</p>
    </footer>
</body>

</html>