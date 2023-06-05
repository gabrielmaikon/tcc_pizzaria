<?php

use PHPUnit\Framework\TestCase;

class SecurityTest extends TestCase
{
    public function testXSSProtection()
    {
        // Simule dados de entrada suscetíveis a XSS
        $nome = '<script>alert("XSS")</script>';
        $comentario = '<img src="x" onerror="alert(\'XSS\')">';

        // Limpe os dados para evitar XSS
        $nomeLimpo = htmlspecialchars($nome);
        $comentarioLimpo = htmlspecialchars($comentario);

        // Verifique se os dados foram limpos corretamente
        $this->assertEquals('&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $nomeLimpo);
        $this->assertEquals('&lt;img src=&quot;x&quot; onerror=&quot;alert(\'XSS\')&quot;&gt;', $comentarioLimpo);
    }
}