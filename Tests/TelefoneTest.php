<?php

namespace Tests;

use Arquitetura\Dominio\Telefone;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
    #[DataProvider("retornaDDNumeroTelefoneInvalido")]
    public function testFormatoDDTelefoneInvalido(string $ddd, string $numero): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("DDD de telefone inválido");

        new Telefone($ddd, $numero);
    }

    public static function retornaDDNumeroTelefoneInvalido(): array
    {
        return [
            [
                "ddd" => "1",
                "numero" => "99999999"
            ]
        ];
    }

    public function testFormatoNumeroTelefoneInvalido(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Número de telefone inválido");

        new Telefone("12", "999999");
    }

    public function testFormatoTelefoneValido(): void
    {
        $this->assertEquals("(12) 99999999", new Telefone("12", "99999999"));
    }
}
