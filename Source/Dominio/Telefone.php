<?php

namespace Arquitetura\Dominio;

class Telefone implements \Stringable
{
    private string $ddd;
    private string $numero;

    public function __construct(string $ddd, string $numero)
    {
        $this->setDDD($ddd);
        $this->setNumero($numero);
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    private function setDDD(string $ddd): void
    {
        if (preg_match('/\d{2}/', $ddd) !== 1) {
            throw new \InvalidArgumentException('DDD de telefone inválido');
        }

        $this->ddd = $ddd;
    }

    public function numero(): string
    {
        return $this->numero;
    }

    private function setNumero(string $numero): void
    {
        if (preg_match('/\d{8,9}/', $numero) !== 1) {
            throw new \InvalidArgumentException('Número de telefone inválido');
        }

        $this->numero = $numero;
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->numero}";
    }
}
