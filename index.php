<?php
session_start();
include_once('conexao.php');
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['email'];

$sql = "SELECT * FROM pedidos ORDER BY nmr_pedido DESC";

$result = $conectar->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <link rel="stylesheet" href="css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <!-- Cabeçalho -->
    <header>
        <h2>Cozinha | <span> PEDIDOS </span></h2>
        <nav>
            <ul>
                <li><a href="#">Relatório diário</a></li>
            </ul>
        </nav>
    </header>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Pizza</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Observação</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['nmr_pedido'] . "</td>";
                    echo "<td>" . $user_data['pizza'] . "</td>";
                    echo "<td>" . $user_data['quantidade'] . "</td>";
                    echo "<td>" . $user_data['observacao'] . "</td>";
                    echo "<td>açoes</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>