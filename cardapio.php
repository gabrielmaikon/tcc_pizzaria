<?php
$title = "CARDAPIO";
require_once('header.php'); ?>

<div class="row  row-col-md-2 col-12 g-0">

    <div class="col pe-1 " style="background: url(_img/pizza-fundo.avif) no-repeat center center; background-size: cover; background-attachment: fixed;">
        <?php
        require_once 'conexaoBD.php';
        $categorias = ["Tradicional", "Doce", "Bebida"];
        foreach ($categorias

            as $cat) :
        ?>
            <h1 class="text-center p-3 <?= $cat ?>-cardapio " style="color: #fff; text-shadow: 4px 4px 3px black"><?= $cat ?></h1>
            <div class="row justify-content-center g-4">
                <?php
                $sql = "SELECT cod, nome, ingredientes, valor, imagem, categoria FROM cardapio WHERE categoria = '$cat'";
                $pizzas = $conexao->query($sql);
                $i = 1;
                while ($pizza = mysqli_fetch_array($pizzas)) :
                ?>
                    <div class="col-2">
                        <div class="card">
                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/" . $pizza['imagem'] ?>" class="card-img-top" alt="Pizza de <?= $pizza['nome'] ?>" style="height: 200px">
                            <div class="card-body">
                                <h4 class="card-title" id="<?= $pizza['id'] ?>"><?= $pizza['nome'] ?></h4>
                                <p class="card-text" style="height: 60px"><?= $pizza['ingredientes'] ?></p>
                                <button style="cursor: default;" class="btn btn-success" id="<?= $pizza['cod'] ?>" value="<?= $pizza['valor'] ?>"> Preço:
                                    R$ <?= number_format($pizza['valor'], 2, ",", ".") ?></button>
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
        html,
        body {
            overflow: hidden;
        }

        table td img {
            width: 22px;
        }
    </style>
</div>
<script>
    window.onload = function() {
        let index = 1;

        function scroll() {
            let cat = ["Tradicional", "Doce", "Bebida"];
            let target = $(`.${cat[index]}-cardapio`);

            if (index < cat.length && target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);

                index++;
                return false;
            } else {
                index = 0;
            }
        }

        setInterval(() => {
            scroll();
        }, 7000);
    }
</script>