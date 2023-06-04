<?php require_once('verificarAcesso.php'); ?>
<?php
unset($_SESSION['email']);
header("location:index.php");
?>