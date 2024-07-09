<?php

namespace Arquitetura\Infra\Aluno;

use Arquitetura\Dominio\Aluno\Aluno;
use Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Arquitetura\Dominio\Cpf;
use Arquitetura\Infra\Aluno\Exception\AlunoNaoEncontradoException;
use Arquitetura\Infra\Aluno\Exception\MaisDeUmAlunoComMesmoCpfException;

class RepositorioDeAlunoEmMemoria implements RepositorioDeAluno
{
    private array $alunos = [];

    public function adicionar(Aluno $aluno): int
    {
        $this->alunos[] = $aluno;

        return (int) array_key_last($this->alunos);
    }

    public function buscarPorCpf(Cpf $cpf): Aluno
    {
        $alunosFiltrados = array_filter(
            $this->alunos,
            fn (Aluno $aluno) => $aluno->cpf() == $cpf
        );

        $totalDeAlunos = count($alunosFiltrados);

        if ($totalDeAlunos === 0) {
            throw new AlunoNaoEncontradoException($cpf);
        }

        if ($totalDeAlunos > 0) {
            throw new MaisDeUmAlunoComMesmoCpfException($cpf);
        }

        return $alunosFiltrados[0];
    }

    public function buscarTodos(): array
    {
        return $this->alunos;
    }
}
