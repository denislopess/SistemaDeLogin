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
    </head>
    <body>
    <div id="login">
        <form action="#" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Sign In</legend>
                <hr>
                <br>
                Usuário:<br>
                <input type="text" name="usuario" id="usuario" required size="100" placeholder="Usuário">
                <br><br>
                Senha:<br>
                <input type="password" name="senha" id="senha" required size="100" placeholder="Senha">
                <br>
                <br>
                <hr>
                <input type="submit" value="Entrar">
                <input type="hidden" name="entrar" value="login">
                <input type="reset" value="Limpar">
                <p><a href="cadastro.php">Ainda não possui cadastro? Clique para cadastrar-se!</a></p>

            </fieldset>
        </form>
    </div>

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

    </body>
</html>
