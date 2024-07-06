<?php

namespace Tests;

use Arquitetura\Dominio\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function testFormatoCpfInvalido(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("CPF no formato inválido");

        new Cpf("00000000001");
    }

    public function testFormatoCpfValido(): void
    {
        $cpf = "000.000.000-01";

        $this->assertEquals(new Cpf($cpf), $cpf);
    }
}
