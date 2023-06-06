<?php

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function testAcessoPermitido()
    {
        // Simular uma sessão válida
        $_SESSION['email'] = 'exemplo@example.com';

        // Chamar o código a ser testado
        ob_start();
        require './verificaAcesso.php'; // Substitua pelo caminho real do arquivo contendo o código
        $output = ob_get_clean();

        // Verificar se o redirecionamento não ocorreu
        $this->assertStringNotContainsString('location:acessoNegado.php', implode('', headers_list()));
        $this->assertEmpty($output);
    }
}