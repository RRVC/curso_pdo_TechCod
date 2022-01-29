<?php

// ------------------------------------------------------------- CONEXÃO -------------------------------------------------------------

/*
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", "");
} catch (PDOException $e) {
    echo "Erro com banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro genérico:" . $e->getMessage();
}
*/

// ------------------------------------------------------------- INSERT -------------------------------------------------------------



Metódo 1: Serve para quando precisamos passar algum parametro e depois substituir.
$res = $pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");

$res->bindValue(":n", "Fulano");
$res->bindValue(":t", "999887766");
$res->bindValue(":e", "Fulano@email.com");
$res->execute();

$nome = "Fulano";
$res->bindParam(":n", $nome);


Metódo 2: Quando o comando não precisa fazer nenhuma substituição.
$pdo->query("INSERT INTO pessoa (nome, telefone, email) VALUES ('Ciclano', '955443322', 'Ciclano@email.com')");



// ------------------------------------------------------------- DELETE E UPDATE -------------------------------------------------------------


$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 2;

$cmd->bindValue(":id", $id);
$cmd->execute();


$cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$id = 3;

$cmd->bindValue(":id", $id);
$cmd->bindValue(":e", "Fulano_2@email.com");
$cmd->execute();


// ------------------------------------------------------------- SELECT -------------------------------------------------------------

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");

$cmd->bindValue(":id", 3);
$cmd->execute();
$array_transformado2 = $cmd->fetch();
echo "<pre>";
print_r($array_transformado2);
echo "</pre>";

echo "<hr>";

$cmd->bindValue(":id", 3);
$cmd->execute();
$array_transformado = $cmd->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($array_transformado);
echo "</pre>";

echo "<hr>";

foreach ($array_transformado as $key => $value) {
    echo $key . ": " . $value . "<br>";
}