<?php
$title = 'Acesso negado';

require_once('header.php');
?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
    session_start();

    $email = $_POST['txtEmail'];
    $senha = $_POST['txtSenha'];

    require_once 'conexaoBD.php';

    $sql = "SELECT u.*, c.nome AS cargo FROM usuario u JOIN cargo c ON u.cargo_id = c.id WHERE email = '" . $email . "';";
    $resultado = $conexao->query($sql);

    $linha = mysqli_fetch_array($resultado);

    if ($linha !== null) {
        if ($linha['senha'] === $senha) {
            if ($linha['cargo'] === 'gerente') {
                echo
                '<a href="gerente.php">
                <h1 id="btn1" class=" w3-display-middle" ">Olá ' . $linha["nome"] . ' Seja Bem Vindo(a) </h1>
                </a>';

                $_SESSION['email'] = $email;
                $_SESSION['cargo_id'] = $linha['cargo_id'];
            } elseif ($linha['cargo'] === 'atendente') {
                echo
                '<a href="atendente.php">
                <h1 id="btn2" class="  w3-display-middle" ">Olá ' . $linha["nome"] . ' Seja Bem Vindo(a) </h1>
                </a>';

                $_SESSION['email'] = $email;
                $_SESSION['cargo_id'] = $linha['cargo_id'];
            } elseif ($linha['cargo'] === 'cozinha') {
                echo
                '<a href="cozinha.php">
                <h1 id="btn3" class=" w3-display-middle" ">Olá ' . $linha["nome"] . ' Seja Bem Vindo(a) </h1>
                </a>';

                $_SESSION['email'] = $email;
                $_SESSION['cargo_id'] = $linha['cargo_id'];
            }
        } else {
            echo '
            <a href="login.php">
            <h1 class="w3-button w3-teal w3-display-middle" style="background-color: red !important">Login Inválido! </h1>
            </a>';
        }
    } else {
        echo '
            <a href="login.php">
            <h1 class="w3-button w3-teal w3-display-middle" style="background-color: red !important">Login Inválido! </h1>
            </a>';
    }

    ?>
    <style>
        #btn1,
        #btn2,
        #btn3 {
            background-color: #60fa41;
            border: none;
            width: 700px;
            text-align: center;
            color: white;
        }

        #btn1:hover {
            background-color: #32CD32;
            color: black
        }

        #btn2:hover {
            background-color: #32CD32;
            color: black
        }

        #btn3:hover {
            background-color: #32CD32;
            color: black
        }
    </style>
</div>
<?php require_once('footer.php'); ?>