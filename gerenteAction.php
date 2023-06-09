<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\SocketHandler;
use Monolog\Formatter\JsonFormatter;

require_once('conexaoBD.php');

// Crie uma instância do logger
$logger = new Logger('pizzaria');

// Configure o SocketHandler para enviar logs para o Logstash
$socketHandler = new SocketHandler('tcp://localhost:5044');
$socketHandler->setFormatter(new JsonFormatter());
$logger->pushHandler($socketHandler);

$nomeFunc = $_POST['txtNome'];
$emailFunc = $_POST['txtEmail'];
$senhaFunc = $_POST['txtSenha'];
$dataNascFunc = $_POST['txtDataNasc'];
$enderecoFunc = $_POST['txtEndereco'];
$telefoneFunc = $_POST['txtTelefone'];
$celularFunc = $_POST['txtCelular'];
$cpfFunc = $_POST['txtCpf'];
$cargoFunc = $_POST['selectCargo'];
//-----------------------------------

$sql = "INSERT INTO usuario (nome, email, senha, data_nasc, endereco, telefone, celular, cpf, cargo_id) VALUES ('" . $nomeFunc . "', '" . $emailFunc . "', '" . $senhaFunc . "', '" . $dataNascFunc . "', '" . $enderecoFunc . "', '" . $telefoneFunc . "', '" . $celularFunc . "', '" . $cpfFunc . "', " . $cargoFunc . ")";

if ($conexao->query($sql)) {
    echo '
       <a href="gerente.php">
            <h1 class="w3-button w3-teal w3-display-middle"> Salvo com sucesso! </h1>
        </a>
             ';
    $logger->info('Funcionário inserido com sucesso!');
} else {
    echo '
        <a href="gerente.php">
           <h1 class="w3-button w3-teal w3-display-middle" style="background-color: red !important">ERRO! </h1>
       </a>
           ';
    $logger->info('Erro ao inserir funcionário!');
}

?>
<style>
    #btn1 {
        background-color: #60fa41;
        border: none;
        width: 700px;
        text-align: center;
        color: white;
    }
</style>
<?php require_once('footer.php'); ?>