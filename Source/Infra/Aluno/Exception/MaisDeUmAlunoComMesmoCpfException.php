<?php

namespace Arquitetura\Infra\Aluno;

class MaisDeUmAlunoComMesmoCpfException extends \DomainException
{
    public function __construct(string $cpf)
    {
        parent::__construct("Há mais de um aluno com este CPF({$cpf})");
    }
}
