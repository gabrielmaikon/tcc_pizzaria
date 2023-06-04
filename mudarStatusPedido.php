<?php
require_once 'conexaoBD.php';

$idPedido = $_POST['idPedido'];
$value = $_POST['value'];

// UPDATE `sistema_da_pizzaria`.`pedido` SET `status` = 'Pronto' WHERE (`id` = '18');
$sqlUpdate = "UPDATE pedido SET status = '$value' WHERE id = $idPedido";
$conexao->query($sqlUpdate);
