<?php
$title = "Gerencia";

require_once('header.php');
require_once('conexaoBD.php');

session_start();

// validaPerfil($_SESSION['cargo_id']);

$sqlCargo = "SELECT id, nome FROM cargo";
$getCargo = $conexao->query($sqlCargo);
?>
<br><br><br><br><br>
<form class=" col-5 m-auto p-5" action="gerenteAction.php" method="post">
    <div id="newFunc">
        <h1 class="text-center " style="color: #000;  text-shadow: 4px 4px 3px #60fa41">Adicionar Funcionário</h1>
    </div>

    <div class="w3-section ">
        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa fa-user" style="color: #ce2424"></i>

            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="text" placeholder="Digite o Nome" name="txtNome" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa fa-envelope-o" style="color: #36da16"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="email" placeholder="Digite o Email" name="txtEmail" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa fa-lock" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="password" placeholder="Digite a Senha" name="txtSenha" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa fa-calendar" style="color: #36da16"></i>
            </div>

            <div class="w3-rest">Data de Nascimento
                <input class="textbox w3-input w3-border mb-2" type="date" placeholder="Digite a Data de Nascimento" name="txtDataNasc" id="date" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%">
                <i class="w3-xxlarge fa-solid fa fa-location-arrow" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="text" placeholder="Digite o Endereço Ex: Rua São Francisco" name="txtEndereco" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%">
                <i class="w3-xxlarge fa-sharp fa-solid fa fa-phone" style="color: #36da16"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="number" placeholder="Digite o Telefone" name="txtTelefone">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%">
                <i class="w3-xxxlarge fa-solid fa fa-mobile" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="number" placeholder="Digite o Celular" name="txtCelular">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa fa-drivers-license" style="color: #36da16"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="number" placeholder="Digite o cpf" name="txtCpf" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa-solid fa fa-briefcase" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <select class="form-select" required name="selectCargo">
                    <option class="form-select" selected>Selecione o cargo</option>
                    <?php
                    while ($cargo = mysqli_fetch_assoc($getCargo)) : ?>
                        <option class="form-select" value="<?= $cargo['id'] ?>"><?= ucfirst($cargo['nome']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <button id="btn1" class=" w3-block w3-section w3-padding" type="submit" style="background-color: #37e620; border: none;">Adicionar</button>
    </div>
</form>

<br><br><br><br><br>

<form class=" col-5 m-auto p-5" action="gerenteActionProduto.php" method="post" enctype="multipart/form-data">
    <div id="newFunc">
        <h1 class="text-center" style="color: #000;  text-shadow: 4px 4px 3px #60fa41">Adicionar Produto</h1>
    </div>

    <div class="w3-section">
        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa-solid fa fa-pencil" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="text" placeholder="Digite o Nome do Produto" name="txtProd" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa-solid fa fa-clipboard" style="color: #60fa41"></i>
            </div>
            <div class="w3-rest">
                <select class="form-select" name="txtCategoria">
                    <option selected>Selecione a categoria</option>
                    <option value="Tradicional">Tradicional</option>
                    <option value="Doce">Doce</option>
                    <option value="Bebida">Bebida</option>
                </select>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <span style="font-size: 33px; color: #ce2424">R$<span>

            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="number" placeholder="Digite o Valor" name="txtValor" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%;">
                <i class="w3-xxlarge fa-sharp fa fa-solid fa-comment" style="color: #60fa41"></i>
            </div>
            <div class="w3-rest">
                <textarea id="desc" name="txtDesc" rows="5" cols="46" placeholder="Ingredientes..." class="p-2"></textarea>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col text-center" style="width:11%">
                <i class="w3-xxlarge fa-solid fa fa-image" style="color: #ce2424"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border mb-2" type="file" accept="image/*" placeholder="Insira a Imagem" name="txtImg">
            </div>
        </div>

        <button id="btn2" class="w3-block  w3-section w3-padding" type="submit" style="background-color: #37e620; border:none;">Adicionar</button>
    </div>
</form>
<style>
    #btn1:hover {
        color: #fff;
    }

    #btn2:hover {
        color: #fff;
    }
</style>
<?php require_once('footer.php'); ?>