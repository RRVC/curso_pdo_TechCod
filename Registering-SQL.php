<?php

    class RegisteringSQL {

        private $pdo;

        public function __construct($dbname, $host, $user, $pass) {

            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$pass);
            } catch (PDOException $e) {
                echo "Erro com banco de dados: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro genérico: " . $e->getMessage();
                exit();
            }
        }

        public function buscarDados() {
            $res = array();
            $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome ASC");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        }

        public function insert($nome, $telefone, $email) {

            $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");

            $cmd->bindValue(":e", $email);
            $cmd->execute();
            if($cmd->rowCount() > 0) { #Se o row count for maior que 0 é porque o dado já existe.
                return false;
            } else {
                $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES ( :n, :t, :e)");

                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":t",$telefone);
                $cmd->bindValue(":e",$email);
                $cmd->execute();
                return true;
            }
        }

        public function delete($id) {
            $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
        }

        public function update($id, $nome, $telefone, $email) {
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }

        public function getData($id) {
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();

            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

    }

?>