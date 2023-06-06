<?php

use PHPUnit\Framework\TestCase;

require_once './conexaoBD.php';

class ValidaPerfilTest extends TestCase
{
    // Simular a função de conexão com o banco de dados
    function conexao()
    {
        return $this->createMock(mysqli::class);
    }

    public function testPerfilPermitido()
    {
        // Definir o cargo ID
        $cargo_id = 1;

        // Definir a URL
        $_SERVER['REQUEST_URI'] = '/atendente.php';

        // Chamar a função validaPerfil
        ob_start();
        validaPerfil($cargo_id);
        $output = ob_get_clean();

        // Verificar se o resultado esperado foi retornado
        $this->assertEmpty($output);
    }
}