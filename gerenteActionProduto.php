<?php
require_once('conexaoBD.php');

$codProd = str_split((string)(time() * rand()), 3);
$nomeProd = $_POST['txtProd'];
$categoriaProd = $_POST['txtCategoria'];
$valorProd = $_POST['txtValor'];
$descProd = $_POST['txtDesc'];

$imgPath = '_img/' . $_FILES['txtImg']['name'];
$imgTempName = $_FILES["txtImg"]["tmp_name"];

try {
    move_uploaded_file($imgTempName, $imgPath);

    $sql = "
    INSERT INTO 
        cardapio (cod, nome, categoria, valor, ingredientes, imagem) 
    VALUES (" . $codProd[0] . ", '" . $nomeProd . "', '" . $categoriaProd
        . "', '" . $valorProd . "', '" . $descProd . "', '" . $imgPath . "')";

    if ($conexao->query($sql)) {
        echo '
       <a href="gerente.php">
            <h1 class="w3-button w3-teal w3-display-middle">Salvo com sucesso!</h1>
       </a> ';
    } else {
        echo '
        <a href="gerente.php">
           <h1 class="w3-button w3-teal w3-display-middle" style="background-color: red !important">ERRO!</h1>
       </a>';
    }
} catch (Exception $e) {
    $message = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
    json_encode($message);
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