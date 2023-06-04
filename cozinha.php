<?php
$title = "Cozinha";

require_once('header.php');
require_once('conexaoBD.php');

session_start();

validaPerfil($_SESSION['cargo_id']);

$sql = "SELECT * FROM pedido WHERE DATE(data) = CURDATE() AND status <> 'Entregue' ORDER BY data";

$result = $conexao->query($sql);

$background = array(
    'A Fazer' => 'bg-light',
    'Em Preparo' => 'bg-warning',
    'Pronto' => 'bg-success'
);
?>

<body>
    <?php

    $perfil = getPerfil($_SESSION['cargo_id']);

    if ($perfil === 'cozinha' || $perfil === 'gerente') : ?>
        <!-- Cabeçalho -->
        <header>
            <h2>Cozinha | <span> PEDIDOS </span></h2>
        </header>
        <div class="m-5">
            <table class="table table-bg">
                <thead>
                    <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">Quantidade / Item</th>
                        <th scope="col">Observação</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_assoc($result)) :

                        $sqlItens = "SELECT car.nome AS nome, ip.qtd_item AS qtd, ip.pedido_id 
                                        FROM sistema_da_pizzaria.itens_pedido ip
                                        INNER JOIN sistema_da_pizzaria.cardapio car
                                            ON car.id = ip.cardapio_id
                                        WHERE ip.pedido_id = " . $user_data['id'];
                        $resultItens = $conexao->query($sqlItens);
                    ?>
                        <tr id="pedido-<?= $user_data['id'] ?>" class="align-middle <?= $background[$user_data['status']] ?>" style="--bs-bg-opacity: .75;">
                            <td><?= $user_data['numero'] ?></td>
                            <td>
                                <?php while ($item_data = mysqli_fetch_assoc($resultItens)) : ?>
                                    <p><?= $item_data['qtd'] ?> / <?= $item_data['nome'] ?></p>
                                <?php endwhile; ?>
                            </td>
                            <td><?= $user_data['observacoes'] ?></td>
                            <td>
                                <select class="form-select status-select" aria-label="Default select example" data-value="<?= $user_data['status'] ?>" onchange="mudarStatus(this, this.value, '<?= $user_data['id'] ?>')">
                                    <option value="A Fazer" <?= $user_data["status"] == "A Fazer" ? "selected" : "" ?>>A Fazer
                                    </option>
                                    <option value="Em Preparo" <?= $user_data["status"] == "Em Preparo" ? "selected" : "" ?>>Em
                                        Preparo
                                    </option>
                                    <option value="Pronto" <?= $user_data["status"] == "Pronto" ? "selected" : "" ?>>Pronto</option>
                                    </option>
                                    <option value="Entregue" <?= $user_data["status"] == "Entregue" ? "selected" : "" ?>>Entregue
                                    </option>
                                    </option>
                                </select>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        <script>
            function mudarStatus(select, value, idPedido) {
                const element = document.getElementById(`pedido-${idPedido}`);
                let isDelivery = false;

                if (value === "Entregue") {
                    isDelivery = confirm("O pedido realmente foi entregue?");
                    if (isDelivery) {
                        element.remove();
                    } else {
                        select.value = select.dataset.value;
                    }
                }

                if (value !== "Entregue" || isDelivery) {
                    $.ajax({
                        type: 'POST',
                        url: 'mudarStatusPedido.php',
                        dataType: 'html',
                        data: {
                            idPedido,
                            value
                        },
                        success: function(data) {
                            const status = <?= json_encode($background) ?>;
                            const classes = element.className;

                            select.setAttribute('data-value', value);
                            element.className = classes.replace(/bg-\w+/g, status[value]);
                        },
                        error: function(err) {
                            console.log("ERROR! ", err.responseText);
                        },
                    });
                }
            }
        </script>
    <?php
    elseif ($perfil === 'atendente') : ?>
        <header>
            <h2>Acompanhe seu pedido AQUI</h2>
        </header>
        <div class="mt-5">
            <table class="table table-bg pedido-cliente">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="background-color: lightblue">A fazer</th>
                        <th scope="col" class="text-center" style="background-color: lightgray">Em Preparo</th>
                        <th scope="col" class="text-center" style="background-color: #60fa41">Pronto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = array(
                        'A Fazer' => array(),
                        'Em Preparo' => array(),
                        'Pronto' => array()
                    );

                    while ($user_data = mysqli_fetch_assoc($result)) {
                        if ($user_data['status'] === 'A Fazer') {
                            array_push($status['A Fazer'], $user_data['id']);
                        } elseif ($user_data['status'] === 'Em Preparo') {
                            array_push($status['Em Preparo'], $user_data['id']);
                        } elseif ($user_data['status'] === 'Pronto') {
                            array_push($status['Pronto'], $user_data['id']);
                        }
                    }
                    ?>
                    <tr class="text-center fs-1">
                        <td>
                            <?php
                            foreach ($status['A Fazer'] as $index => $sa) {
                                // if (count($status['A Fazer']) >= 8) {
                                //     echo '<p>' .  $sa . ' ' . $status['A Fazer'][$index + 1] . '</p>';
                                // } else {
                                    echo '<p>' . $sa . '</p>';
                                // }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($status['Em Preparo'] as $se) {
                                echo '<p>' . $se . '</p>';
                            }
                            ?></td>
                        <td>
                            <?php
                            foreach ($status['Pronto'] as $sp) {
                                echo '<p>' . $sp . '</p>';
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    endif;
    ?>
</body>

</html>