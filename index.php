<?php
    require_once 'classe.php';
    $p = new Conteudos("card","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer type="text/javascript" src="main.js"></script>
    <title>Teste com Cards</title>
</head>
<body>
    <div class="body">
        <div class="content">
            <header class="menu">
                <img src="img/logo.png" class="logo" alt="logo">
                    <ul>
                        <li><a href="cadastro.php">Cadastrar</a></li>
                    </ul>
            </header>
            <?php
            $dados = $p->buscaCard();
                if (count($dados) >0) {
                for ($i=0; $i < count($dados); $i++) { 
                    echo "<div class='cards'>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id" && $k != "conteudo") {
                        echo "<h1>".$v."</h1>";
                        }
                        if ($k != "id" && $k != "titulo") {
                            echo "<p>".$v."</p>";
                        }
                    }
            ?>
                <button class="mais"><a href="cadastro.php?id_update=<?php echo $dados[$i]['id'];?>">Editar</a></button>
                <button class="excluir"><a onclick="return confirmation();" href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a></button>
            <?php
            echo "</div>";
                }
            }
            ?>
            <footer class="footer">2022</footer> 
        </div>        
    </div>
</body>
</html>
<?php
    if (isset($_GET['id'])) {
       $id = addslashes($_GET['id']); 
       $p->excluir($id);
       header("location: ./index.php"); //atualiza a pagina depois de excluir
    }
?>