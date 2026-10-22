<?php
    session_start();
    require 'conexao.php';

    $erro = "";

    if($_POST){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios where email = '$email' AND senha = MD5('$senha')";

        $resultado = $conn->query($sql);
        $user = $resultado->fetch_assoc();

        if($user){
            $_SESSION['usuarios'] = $user['nome'];
            header("Location: principal.php");
            exit();
        }else{
            $erro = "Login Inválido!";
        }
    }
?>

<form method="POST">
    <h2>Login</h2>
    <?php if($erro) { echo $erro;} ?>

    <br>

    E-mail
    <input type="email" name="email">
    
    Senha:
    <input type="password" name="senha">
    <button type="submit">Entrar</button>
</form>