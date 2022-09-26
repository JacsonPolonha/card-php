<?php
    class Conteudos{
        public function __construct($dbname, $host, $user, $senha) {
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
            } catch (Exception $e) {
                echo "Erro com banco de dados: ".$e->getMessage();
            } catch (Exception $e) {
                echo "Erro generico: ".$e->getMessage();
            } 
        }
   

        
        public function buscaCard() {
            $res = array();
            $cmd = $this->pdo->query("SELECT * FROM card ORDER BY titulo");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }



        public function cadastrar($titulo, $conteudo){
            $cmd = $this->pdo->prepare("SELECT id from card WHERE titulo = :t");
            $cmd->bindValue(":t",$titulo);
            $cmd->execute();
            if ($cmd->rowCount() > 0) {
                return false;
            } else {
                $cmd = $this->pdo->prepare("INSERT INTO card (titulo, conteudo) VALUES (:t, :c)");
                $cmd->bindValue(":t",$titulo);
                $cmd->bindValue(":c",$conteudo);
                $cmd->execute();
                return true;
            }
        }
        

        public function excluir($id) {
            $cmd = $this->pdo->prepare("DELETE FROM card WHERE id = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
       }


       public function editar($id){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM card WHERE id = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
       }


       public function atualizar($id, $titulo, $conteudo){
            $cmd = $this->pdo->prepare("UPDATE card SET titulo = :t, conteudo = :c WHERE id = :id");
            $cmd->bindValue(":t",$titulo);
            $cmd->bindValue(":c",$conteudo);
            $cmd->execute();
       }
    }

    
    