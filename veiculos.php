<?php
    session_start();
    require "conexao.php";

    if(!isset($_SESSION['usuarios'])){
        header("location: index.php");
        exit();
    }

    if($_POST){
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $cliente_id = $_POST['cliente_id'];

        $sql = "INSERT INTO veiculos (placa, modelo, cliente_id) VALUES ('$placa','$modelo','$cliente_id')";

        $conn->query($sql);
    }

    $sql = "SELECT id_cliente, nome FROM clientes";
    $clientes = $conn->query($sql);

    $sql = "SELECT veiculos.*, clientes.nome FROM veiculos INNER JOIN clientes ON veiculos.cliente_id = clientes.id_cliente";

    $veiculos = $conn->query($sql);
?>

<a href="principal.php">Voltar</a>

<h2>Gerenciamento de Veículos</h2>
    <form method="POST">
        <label for="">Placa:</label>
        <input type="text" name="placa" placeholder="Digite sua Placa" required>

        <label for="">Modelo:</label>
        <input type="text" name="modelo" placeholder="Digite seu Modelo" required>

        <label for="">Cliente:</label>
        <select name="cliente_id" required>
            <?php while($c = $clientes->fetch_assoc()){ ?>
                <!-- Corrigido de $c['id'] para $c['id_cliente'] -->
                <option value="<?=$c['id_cliente']?>">
                    <?=$c['nome']?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Salvar</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Nome</th>
        </tr>

        <?php while($v = $veiculos->fetch_assoc()){?>

        <tr>
            <td><?= $v['id']?></td>
            <td><?= $v['placa']?></td>
            <td><?= $v['modelo']?></td>
            <td><?= $v['nome']?></td>
        </tr>

        <?php
        }
        ?>
    </table>