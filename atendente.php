<?php
$title = "Atendente";

require_once('header.php');
require_once 'conexaoBD.php';

session_start();

validaPerfil($_SESSION['cargo_id']);
?>

<div class="row  row-col-md-2 col-12 g-0">
    <div class="col col-7 pe-1 " style="background: url(_img/pizza-fundo.avif) no-repeat center center; background-size: cover; background-attachment: fixed;">
        <?php
        $categorias = ["Tradicional", "Doce", "Bebida"];
        foreach ($categorias

            as $cat) :
        ?>
            <h1 class="text-center p-3 " style="color: #fff; text-shadow: 4px 4px 3px black"><?= $cat ?></h1>
            <div class="row g-4">
                <?php
                $sql = "SELECT cod, nome, ingredientes, valor, imagem, categoria FROM cardapio WHERE categoria = '$cat'";
                $pizzas = $conexao->query($sql);
                $i = 1;
                while ($pizza = mysqli_fetch_array($pizzas)) :
                ?>
                    <div class="col-3">
                        <div class="card">
                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/" . $pizza['imagem'] ?>" class="card-img-top" alt="Pizza de <?= $pizza['nome'] ?>" style="height: 200px">
                            <div class="card-body">
                                <h4 class="card-title" id="<?= $pizza['id'] ?>"><?= $pizza['nome'] ?></h4>
                                <p class="card-text" style="height: 75px"><?= $pizza['ingredientes'] ?></p>
                                <label for="quantidade<?= $i ?>">Quantas?</label>
                                <input id="quantidade<?= $i ?>" class="m-1" type="number" value="1" min="1" oninput="validity.valid ? this.save = value : value = this.save;" style="width: 50px">
                                <button class="btn btn-success" id="<?= $pizza['cod'] ?>" value="<?= $pizza['valor'] ?>" onclick="produto.salvar('<?= $pizza['cod'] ?>', '<?= $pizza['nome'] ?>' , '<?= $pizza['valor'] ?>', document.getElementById('quantidade<?= $i ?>').value)">
                                    Preço: R$ <?= number_format($pizza['valor'], 2, ",", ".") ?></button>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;

                endwhile;
            endforeach;
            ?>
            </div>
    </div>
    <style>
        table td img {
            width: 22px;
        }
    </style>
    <div class="col-5  p-2 g-0  " style="position: fixed; right: 0px; overflow-y:auto; overflow-x: hidden;height: 100vh;">
        <h1 class="text-center p-3" id="pedido" style="color: #000; text-shadow: 4px 4px 3px #60fa41">Pedido</h1>
        <h1 class="text-center p-3" id="pedidoGerado" style="color: #000; text-shadow: 4px 4px 3px #60fa41"></h1>

        <div class="text-center p-2  ">
            <button class="btn btn-success" style="font-weight: bolder; background-color:	#32CD32; color: black" onclick="produto.finalizar()">Finalizar
                Pedido
            </button>
        </div>

        <div class="w-100" style="background: white;">
            <p id="totalPedido" class="p-2" style="color: red;">Valor do Pedido: R$ 0</p>
        </div>
        <table id="tabela" class="w-100" style="overflow: scroll;">
            <thead style="background-color: green;   ">
                <th class="p-1" style="width:33%; border: 1px solid black; background-color: #60fa41">Pizza</th>
                <th class="p-1 text-center" style="width:25%; border: 1px solid black; background-color: white">Quantidade</th>
                <th class="p-1 text-center" style="width:25%; border: 1px solid black; background-color: red">Valor</th>
                <th class="text-center" style=" border: 1px solid black; background-color: white">Ações</th>
            </thead>

            <tbody id="tbody">

            </tbody>
        </table>

        <div class="mt-2">
            <label for="nomeCliente"><strong>Nome cliente:</strong></label>
            <input id="nomeCliente" type="text" class="w-100">
        </div>

        <div class="mt-2">
            <label for="msg"><strong>Observações:</strong></label>
            <textarea id="msg" name="msg" rows="4" cols="50" class="w-100"></textarea>
        </div>

        <div id="alert_sucesso" class="alert alert-success mt-5" role="alert" style="display: none;">
            Pedido Enviado para a Cozinha com Sucesso!!
        </div>

        <div id="alert_erro" class="alert alert-danger mt-5" role="alert" style="display: none;">
            Adicione algum produto!
        </div>
        <?php require_once('footer.php'); ?>