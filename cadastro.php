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
    </head>
    <body>
        <div id="cadastro">
            <form action="" method="post" enctype="multipart/form-data">
                <p><label>Nome:</label><br> <input type="text" name="nome" placeholder="Meu nome"/></p>
                <p><label>Usuário:</label><br> <input type="text" name="usuario" placeholder="Usuário"/></p>
                <p><label>Senha:</label><br> <input type="password" name="senha" placeholder="************"/></p>
                <p><input type="submit" value="Cadastrar"/></p>
                <input type="hidden" name="Cadastrar" value="register"/>
            </form>
        </div>

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
