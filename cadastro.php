<?php
    require_once 'classe.php';
   // require_once 'index.php';
    $p = new Conteudos("card","localhost","root","");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Front cadastro</title>
</head>
<body>
    <div class="body">
        <div class="content">
            <header class="menu">
                <img src="img/logo.png" class="logo" alt="logo">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                    </ul>
            </header>
            <?php
                if(isset($_POST['titulo'])) {

                    if(isset($_GET['id_update'])) {
                        $id_upd = addslashes($_GET['id_update']);
                        $titulo = addslashes($_POST['titulo']);
                        $conteudo = addslashes($_POST['conteudo']);
                        if(!empty($titulo) && !empty($conteudo)) {
                            $p->atualizar($id_upd, $titulo, $conteudo);
                            header("location: index.php");
                        }
                    } else{
                        $titulo = addslashes($_POST['titulo']);
                        $conteudo = addslashes($_POST['conteudo']);
                        header("location: index.php ");
                        if (!empty($titulo) && !empty($conteudo)) {
                            if (!$p->cadastrar($titulo, $conteudo)) {
                                echo "Titulo ja cadastrado";  
                            }
                        } else{
                            echo "Preencha todos os dados";
                        }
                    }


                }//fechamento if post[titulo] 
            ?>
           
           <?php
                if (isset($_GET['id_update'])) {
                    $id_update = addslashes($_GET['id_update']);
                    $res = $p->editar($id_update);
                }
            ?>
            <form action="cadastro.php" method="post" class="form">
                <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php if(isset($res)){echo $res['titulo'];}?>">

                <input type="text" name="conteudo" id="conteudo" class="texto" placeholder="conteudo" value="<?php if(isset($res)){echo $res['conteudo'];}?>">

                

                <input type="submit" value="<?php if(isset($res)){ echo "Atualizar";}else{echo "Cadastrar";}?>">
            </form>
            
            <footer class="footer">2022</footer> 
        </div>
    </div>
</body>
</html>