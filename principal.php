<?php
    session_start();

    if(!isset($_SESSION['usuarios'])){
        header("Location: index.php");
        exit;
    }
?>

<h1>Bem-vindo, <?= $_SESSION['usuarios'] ?></h1>
<a href="clientes.php">Cliente</a>
<a href="veiculos.php">Veículos</a>
<a href="agendamentos.php">Agendamentos</a>
<a href="logout.php">Sair</a>