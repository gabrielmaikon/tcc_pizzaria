<?php
$servername = "localhost";
$username = "root";
$password = "toonworld24";
$dbname = "sistema_da_pizzaria";
$port = 3306;

$conexao = new mysqli($servername, $username, $password, $dbname, $port);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}
$test = "select * from usuario";
$pegartest = mysqli_fetch_assoc($conexao->query($test));
print_r ($pegartest);