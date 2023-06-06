<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sistema_da_pizzaria";
$port = 3306;

$conexao = new mysqli($servername, $username, $password, $dbname, $port);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

function validaPerfil($cargo_id)
{
    global $conexao;

    $url = str_replace('/', '', $_SERVER['REQUEST_URI']);

    $sqlPerfil = '
        SELECT 
            p.permitido
        FROM
            rotas r
                JOIN
            permissao p ON r.id = p.rota_id
        WHERE
            p.cargo_id = ' . $cargo_id . '
            AND r.url = "' . $url . '"
    ';

    $getPerfil = mysqli_fetch_assoc($conexao->query($sqlPerfil));

    if (!isset($getPerfil) || !$getPerfil['permitido']) : ?>
        <h1 class="w3-button w3-teal w3-display-middle" onclick="history.back()" style="background-color: red !important">
            Acesso negado. Seu usuário não tem permissão para visualizar esssa tela.
        </h1>
<?php
        die();
    endif;
}

function getPerfil($cargo_id) {
    global $conexao;
    
    $sqlCargo = '
        SELECT 
            nome
        FROM
            cargo
        WHERE
            id = ' . $cargo_id . '
    ';

    $getCargo = mysqli_fetch_assoc($conexao->query($sqlCargo));

    return $getCargo['nome'];
}