<?php
require_once 'conexaoBD.php';

$valorTotal = $_POST['valorTotal'];

if ($valorTotal) {
    $nuPedido = $_POST['nuPedido'];
    $nomeCliente = $_POST['nomeCliente'];
    $obsevarcao = $_POST['obsevarcao'];
    $produtos = $_POST['produtos'];

    $sqlPedidoInsert = "INSERT INTO pedido (numero, nome_cliente, valor, observacoes) VALUES ('$nuPedido', '$nomeCliente', '$valorTotal', '$obsevarcao')";
    $resInsert = $conexao->query($sqlPedidoInsert);

    if ($resInsert) {
        $pedidoId = mysqli_insert_id($conexao);

        $sqlPedidoNum = "SELECT numero FROM pedido WHERE id = " . $pedidoId;
        $getPedidoNum = $conexao->query($sqlPedidoNum);

        $resPedidoNum = mysqli_fetch_row($getPedidoNum);

        foreach ($produtos as $p) {
            $sqlItemInsert = "INSERT INTO itens_pedido (cardapio_id, pedido_id, qtd_item) VALUES ('" . $p['id'] . "', '$pedidoId', '" . $p['quantidade'] . "')";
            $conexao->query($sqlItemInsert);
        }

        echo $resPedidoNum[0];
    }
}
