<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 18/02/2018
 * Time: 21:09
 */
include_once ('setting.php');
@session_start();

if(isset($_SESSION['nome']) && isset($_SESSION['usuario']) ){
    header('Location:logado.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    </head>
    <body>
    <center>
    <div id="body" class="well well-sm">
    <div id="login">
        <form action="#" method="post" enctype="multipart/form-data">

                <h1>Entrar:</h1>
                <p><label>Usuário:</label></br><input type="text" name="usuario" id="usuario" placeholder="Usuário" class="form form-control"/></p>
                <p><label>Senha:</label></br><input type="password" name="senha" id="senha" placeholder="Senha" class="form form-control"/></p>
                <br>
                <input type="submit" value="Entrar" class="btn btn-success" style="width: 120px"/>
                <input type="hidden" name="entrar" value="login">
                <input type="reset" value="Limpar" class="btn btn-default" style="width: 120px"/>
                <p><a href="cadastro.php">Ainda não possui cadastro? Clique para cadastrar-se!</a></p>

        </form>
    </div>
    </div>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

    <?php

    if(isset($_POST['entrar']) && $_POST['entrar'] == "login"){
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        if(empty($usuario) || empty($senha)){
            echo 'Preencha todos os campos';
        }
        else{

            $stmt = $conn->prepare("SELECT nome, usuario, senha FROM usuarios WHERE usuario = :usuario AND senha = :senha");
            $stmt->bindValue(':usuario',$usuario);
            $stmt->bindValue(':senha',$senha);
            $stmt->execute();

            $result=$stmt->rowCount();
            $res=$stmt->fetch(PDO::FETCH_OBJ);

            if($result > 0 ){
                $_SESSION['nome'] = $res->nome;
                $_SESSION['usuario'] = $res->usuario;
                header('Location: logado.php');
                exit;
            }else{
                echo 'Usuário ou Senha Inválidos!';
            }


        }
    }


    ?>
    </center>
    </body>
</html>
