<?php

namespace Arquitetura;

class CPF implements \Stringable
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        if (strlen($cpf) < 14) {
            throw new \InvalidArgumentException("CPF inválido!");
        }

        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }

}