<?php

namespace Arquitetura\Infra\Aluno\Exception;

class AlunoNaoEncontradoException extends \Exception
{
    public function __construct(string $cpf)
    {
        parent::__construct("Não há um Aluno cadastrado com este CPF({$cpf})");
    }
}
