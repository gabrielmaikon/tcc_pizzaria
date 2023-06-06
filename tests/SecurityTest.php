<?php

use PHPUnit\Framework\TestCase;

class SecurityTest extends TestCase
{
    public function testXSSProtection()
    {
        // Simule dados de entrada suscetíveis a XSS
        $txtNome = '<script>alert("XSS")</script>';
        $txtEmail = '<img src="x" onerror="alert(\'XSS\')">';

        // Limpe os dados para evitar XSS
        $nomeLimpo = htmlspecialchars($txtNome);
        $emailLimpo = htmlspecialchars($txtEmail);

        // Verifique se os dados foram limpos corretamente
        $this->assertEquals('&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $nomeLimpo);
        $this->assertEquals('&lt;img src=&quot;x&quot; onerror=&quot;alert(&#039;XSS&#039;)&quot;&gt;', $emailLimpo);
    }
}