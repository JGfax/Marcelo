<?php
    session_start();
    require "conexao.php";

    if($_POST){
        $data = $_POST['data'];
        $descricao = $_POST['descricao'];
        $cliente_id = $_POST['cliente_id'];
        $veiculo_id = $_POST['veiculo_id'];

        $sql = "INSERT INTO agendamentos (data_agendamento, descricao, cliente_id, veiculo_id) VALUES ('$data','$descricao','$cliente_id','$veiculo_id')";

        $conn->query($sql);
    }

    $clientes = $conn->query("SELECT * FROM clientes");
    $veiculos = $conn->query("SELECT * FROM veiculos");

    // Correções feitas nas linhas de INNER JOIN
    $sql = "SELECT agendamentos.*, clientes.nome, veiculos.modelo FROM agendamentos
     INNER JOIN clientes ON agendamentos.cliente_id = clientes.id_cliente
     INNER JOIN veiculos ON agendamentos.veiculo_id = veiculos.id
     ORDER BY agendamentos.data_agendamento ASC";

    $agendamentos = $conn->query($sql);
?>

<a href="principal.php">Voltar</a>

<h2>Agendamentos</h2>
<form method="POST">
        <label for="">Data:</label>
        <input type="datetime-local" name="data" required>

        <label for="">Descrição:</label>
        <input type="text" name="descricao" placeholder="Digite sua Descrição" required>

        <label for="">Cliente:</label>
        <select name="cliente_id" required>

            <?php while($c = $clientes->fetch_assoc()){ ?>
            
            <option value="<?$c['id']?>">
            <?= $c['nome']?>
            </option>
            ?>

            <?php
            }
            ?>
        </select>
        <br><br>

        Veículo
        <select name="veiculo_id" required>
            <?php
                while($v = $veiculos->fetch_assoc()){
            ?>

            <option value="<?= $v['id'] ?>">
            <?= $v['modelo'] ?>
            </option>

            <?php
                }
            ?>
        </select>

        <button type="submit">Enviar</button>
</form>

<hr>

<table border="1">
    <tr>
        <th>Data</th>
        <th>Serviço</th>
        <th>Clientes</th>
        <th>Veículos</th>
    </tr>

    <?php
    while($a = $agendamentos->fetch_assoc()){ 
    ?>

    <tr>
        <td><?= $a['data_agendamento']?></td>
        <td><?= $a['descricao']?></td>
        <td><?= $a['nome']?></td>
        <td><?= $a['modelo']?></td>
    </tr>

    <?php
    }
    ?>
</table>