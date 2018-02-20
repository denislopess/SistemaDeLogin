<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 19/02/2018
 * Time: 21:36
 */

include_once 'setting.php';

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
        <title>Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div id="body" class="well well-sm">
        <div id="cadastro">
            <form action="" method="post" enctype="multipart/form-data">

                <h1>Cadastrar:</h1>
                <br>
                <p><label>Nome:</label><br> <input type="text" name="nome" placeholder="Meu nome" class="form form-control"/></p>
                <p><label>Usuário:</label><br> <input type="text" name="usuario" placeholder="Usuário" class="form form-control"/></p>
                <p><label>Senha:</label><br> <input type="password" name="senha" placeholder="************" class="form form-control"/></p>
                <input type="submit" value="Cadastrar" style="width: 120px" class="btn btn-success"/>
                <input type="hidden" name="Cadastrar" value="register"/>
                <input type="reset" value="Limpar" style="width: 120px" class="btn btn-default"/>
            </form>
        </div>
        </div>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <?php

        if(isset($_POST['Cadastrar']) && isset ($_POST['Cadastrar']) == "register"){

            $nome = $_POST['nome'];
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];

            if(empty($nome) || empty($usuario) || empty($senha)){
                echo "Preencha todos os campos";
            }else{
                $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
                $stmt->bindValue(':usuario',$usuario);
                $stmt->execute();

                $result = $stmt->rowCount();

                if($result > 0){
                    echo "Usuário já cadastrado.";
                }else{
                    $stmt = $conn->prepare("INSERT INTO usuarios (nome, usuario, senha) VALUES (:nome, :usuario, :senha)");
                    $stmt->bindValue(':nome',$nome);
                    $stmt->bindValue(':usuario',$usuario);
                    $stmt->bindValue(':senha',$senha);

                    if($stmt->execute()){
                        $_SESSION['nome'] = $nome;
                        $_SESSION['usuario'] = $usuario;

                        echo "Cadastro efetuado com sucesso!<br><br/>";
                        echo "Seus dados são: </br>";
                        echo "<b>Usuário: ".$usuario."</br>";
                        echo "Senha: ".$senha."<b></br>";
                        echo "<a href='index.php'>Clique para entrar!</a>";
                    }else{
                        echo "Erro ao cadastrar, contato um administrador!";
                    }
                }

            }

        }

        ?>

    </body>
</html>
