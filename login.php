<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdn.es.gov.br/fonts/font-awesome/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <title> Login </title>
</head>

<body>
  <div class="w3-container w3-round-xxlarge w3-display-middle w3-card-4 w3-third ">
    <div class="w3-center">
      <br>
      <img src="_img/pizzaiolo.png" alt="Pizzaiolo" style="width:40%" class="w3-circle w3-margin-top">
    </div>

    <form class="w3-container " action="LoginAction.php" method="post">
      <div class="w3-section">
        <label style="font-weight: bold;">Usuário</label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Digite o nome" name="txtEmail" required>
        <label style="font-weight: bold;">Senha</label>
        <input class="w3-input w3-border" type="password" placeholder="Digite a Senha" name="txtSenha" required>
        <button id="btn1" class=" w3-block  w3-section w3-padding" type="submit">Entrar</button>
      </div>
    </form>
    <br>
  </div>
  <style>
    #btn1 {
      background-color: #60fa41;
      border: none;
    }

    #btn1:hover {
      background-color: #32CD32;
    }
  </style>
</body>

</html>