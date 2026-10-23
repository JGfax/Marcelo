<?php 
    session_start();
    require "conexao.php";

    if($_POST){
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];

        $sql = "INSERT INTO clientes (nome,cpf,telefone) VALUES ('$nome', AES_ENCRYPT('$cpf', 'chave'), '$telefone')";

        $conn->query($sql);
    }

    $busca = $_GET['busca'] ?? '';

    // ID alterado para id_cliente
    $sql = "SELECT id_cliente, nome, AES_DECRYPT(cpf, 'chave') AS cpf, telefone FROM clientes WHERE nome LIKE '%$busca%'";

    $resultado = $conn->query($sql);

?>

<a href="principal.php">Voltar</a>

<h2>Gerenciamento de Clientes</h2>
    <form method="POST">
        <label for="">Nome:</label>
            <input type="text" name="nome" placeholder="Digite seu Nome" required>

        <label for="">CPF:</label>
            <input type="text" name="cpf" placeholder="Digite seu CPF" required>

        <label for="">Telefone:</label>
            <input type="text" name="telefone" placeholder="Digite seu Telefone" required>

            <button type="submit">Salvar</button>
    </form>
    <hr>

        <form method="GET">
            <input type="text" name="busca" placeholder="Buscar por nome" required>
            <button type="submit">Buscar</button>
        </form>
        <br>

        <table border = "1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
            </tr>

            <?php
                while ($c = $resultado->fetch_assoc()){
            ?>

            <tr>
                <!-- ID alterado para id_cliente -->
                <td><?= $c['id_cliente'] ?></td>
                <td><?= $c['nome'] ?></td>
                <td><?= $c['cpf'] ?></td>
                <td><?= $c['telefone'] ?></td>
            </tr>

            <?php
            }
            ?>
        </table>