<?php

namespace Arquitetura\Dominio\Aluno;

use Arquitetura\Dominio\Cpf;
use Arquitetura\Infra\Aluno\AlunoNaoEncontradoException;

interface RepositorioDeAluno
{
    public function adicionar(Aluno $aluno): int;

    /**
     * @throws AlunoNaoEncontradoException
     */
    public function buscarPorCpf(Cpf $cpf): Aluno;

    /**
     * @return Aluno[] 
     */
    public function buscarTodos(): array;
}
