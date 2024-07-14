<?php

namespace Arquitetura\Aplicacao\Aluno\MatricularAluno;

use Arquitetura\Dominio\Aluno\Aluno;
use Arquitetura\Dominio\Aluno\RepositorioDeAluno;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;

    public function __construct(RepositorioDeAluno $repositorioDeAluno)
    {
        $this->repositorioDeAluno = $repositorioDeAluno;
    }

    public function executar(MatricularAlunoDto $matricularAlunoDto): void
    {
        $aluno = Aluno::comCpfNomeEEmail(
            $matricularAlunoDto->cpf,
            $matricularAlunoDto->nome,
            $matricularAlunoDto->email
        );

        $this->repositorioDeAluno->adicionar($aluno);
    }
}
