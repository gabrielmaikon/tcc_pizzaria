<?php
if (!isset($_SESSION)) {
    session_start();
}
if ((!isset($_SESSION['email']))) {
    header('location:acessoNegado.php');
    die();
}
