<?php
$servername = "localhost";
$username = "root";
$password = "sua_senha";
$dbname = "sistema_da_pizzaria";
$port = 3306;

$conexao = new mysqli($servername, $username, $password, $dbname, $port);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}