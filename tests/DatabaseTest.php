<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testDatabaseConnection()
    {
        // Configuração da conexão com o banco de dados
        $host = 'localhost';
        $username = 'root';
        $password = 'password';
        $database = 'sistema_da_pizzaria';

        // Tenta estabelecer uma conexão com o banco de dados
        $conn = new mysqli($host, $username, $password, $database);

        // Verifica se a conexão foi estabelecida com sucesso
        $this->assertInstanceOf(mysqli::class, $conn);
        $this->assertFalse( boolval($conn->connect_errno) );
    }
}