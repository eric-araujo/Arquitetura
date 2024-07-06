<?php

namespace Tests;

use Arquitetura\Dominio\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testFormatoEmailInvalido(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Endereço de e-mail inválido!");

        new Email("email.com.br");
    }

    public function testFormatoEmailValido(): void
    {
        $email = "email@gmail.com.br";

        $this->assertEquals(
            new Email($email),
            $email
        );
    }
}
