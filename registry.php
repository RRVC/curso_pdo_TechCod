<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registry HTML</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <?php
        include "../model/Registering-SQL.php";
        include "../core/Model.php";

        $students_list = $sql->query("SELECT * FROM `students`");
        $users_list = $sql->query("SELECT * FROM `users`");


        if (mysqli_num_rows($students_list) > 0 || mysqli_num_rows($users_list) > 0){
            echo '<style type="text/css">#all_outputs_container { display: flex;}</style>';
        }

        echo mysqli_num_rows($students_list) == 0 ? '<style type="text/css"> div#students_container.registry_container {display: none}</style>' : '<style type="text/css"> div#students_container.registry_container {display: block}</style>' ;
        echo mysqli_num_rows($users_list) == 0 ? '<style type="text/css"> div#users_container.registry_container {display: none}</style>' : '<style type="text/css"> div#users_container.registry_container {display: block}</style>' ;


        $students_display = "";
        while ($row = $students_list->fetch_assoc()){
            $del = "<input class=\"input_btn\" type='button' value='Excluir cadastro' onclick='remove({$row["id"]})'>";
            $edit = "<input class=\"input_btn\" type='button' value='Editar' onclick='edit_menu({$row["id"]})'>";
            $students_display .= "
                                    <form class=\"user_container\" id=\"user_{$row["id"]}\">
                                        ID : {$row["id"]}<br>
                                        Nome: {$row["name"]}<br>
                                        Telefone: {$row["phone"]}<br>
                                        Nascimento: {$row["birth"]}<br>
                                        Nota: {$row["grade"]}<br>
                                        Data de registro: WIP<br>
                                        Ultima edição: WIP<br>
                                        <div class=\"btn_container\">
                                            {$edit} | {$del}
                                        </div>
                                    </form>
                                    ";
        }
        $students = $students_display;


        $users_display = "";
        while ($row = $users_list->fetch_assoc()){
            $del = "<input class=\"input_btn\" type='button' value='Excluir cadastro' onclick='remove({$row["id"]})'>";
            $edit = "<input class=\"input_btn\" type='button' value='Editar' onclick='edit_menu({$row["id"]})'>";
            $users_display .= "
                                <form class=\"user_container\" id=\"user_{$row["id"]}\">
                                    ID : {$row["id"]}<br>
                                    Nome: {$row["name"]}<br>
                                    Telefone: {$row["phone"]}<br>
                                    Nascimento: {$row["birth"]}<br>
                                    Data de registro: WIP<br>
                                    Ultima edição: WIP<br>
                                    <div class=\"btn_container\">
                                        {$edit} | {$del}
                                    </div>
                                </form>
                                ";
        }
        $users = $users_display;

        if(isset($_GET["deletar"])){
            reg_clear();
        };

        function reg_clear(){
            $sql = new mysqli("localhost", "root","", "crud");
            $value = $_GET["deletar"];

            if ($value == 1){
                $sql->query("TRUNCATE TABLE `students`");
            } elseif ($value == 2){
                $sql->query("TRUNCATE TABLE `users`");
            }
            header("Location: Registry_HTML.php");
        };

    ?>
    <script>
        function reg_clear(category){
            var category_value = category;
            category == 1 ? category = "alunos" : category = "não alunos";
            if (confirm(`Tem certeza que deseja deletar registro de ${category}?`)){
                window.location.href = `Registry_HTML.php?deletar=${category_value}`;
            }
        }
    </script>
</head>
<body>
    <h1>Cadastros</h1>
    <section>
<!-- ========================================================== OUTPUT DISPLAY ========================================================== -->

        <div id="all_outputs_container">

            <div class="registry_container" id="students_container">
                <h1>Alunos</h1>
                <div class="list_container">
                    <?=$students?>
                </div>
                <form action="Registry_HTML.php" method="get">
                    <div class="btn_container">
                        <button class="input_btn" name="deletar" type="button" onclick="reg_clear(1)" value="1">Limpar Registro</button>
                    </div>
                </form>
            </div>

            <div class="registry_container" id="users_container">
                <h1>Não alunos</h1>
                <div class="list_container">
                    <?=$users?>
                </div>
                <form action="Registry_HTML.php" method="get">
                    <div class="btn_container">
                        <button class="input_btn" name="deletar" type="button" onclick="reg_clear(2)" value="2">Limpar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


<!-- ========================================================== USER EDITING ========================================================== -->

    <div id="edit">
        <div id="editing_container">

            <h1 id="editing_user"></h1>

            <div class="input_container" id="edit_name_container">
                <span>Nome: </span>
                <input type="text" class="edit_input_field" name="edit_name_input" id="edit_name_input" placeholder="Digite seu nome" maxlength="30" autofocus>
            </div>
            <div class="input_container" id="edit_tel_container">
                <span>Telefone: </span>
                <input type="text" class="edit_input_field" name="edit_tel_input" id="edit_tel_input" placeholder="Digite seu telefone" maxlength="12">
            </div>
            <div class="input_container" id="edit_birth_container">
                <span>Nascimento: </span>
                <input type="date" class="edit_input_field" name="edit_birth_input" id="edit_birth_input">
            </div>
            <div class="input_container" id="edit_grade_container">
                <span>Nota: </span>
                <input type="text" class="edit_input_field" name="edit_grade_input" id="edit_grade_input" maxlength="3" style="width: 50px;">
            </div>
            <div class="btn_container">
                <input class="input_btn" type="button" value="OK" onclick="edit()">
                <input class="input_btn" type="button" value="Cancelar" onclick="edit_menu(null,null,'none')">
            </div>
            <div class="error_msg">
                <span class="out_msg"></span>
            </div>

        </div>
    </div>
    <footer>
        <a class="input_btn" href="Registering_HTML.php" style="margin: auto;">Voltar</a>
        <p>&copy; RRVTI</p>
    </footer>
</body>
</html>