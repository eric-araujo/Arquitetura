<?php

namespace Tests\Aplicacao\Aluno;

use Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Arquitetura\Dominio\Cpf;
use Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;

class MatricularAlunoTest extends \PHPUnit\Framework\TestCase
{
    public function testMatricularAluno()
    {
        $matriculaAlunoDto = new MatricularAlunoDto(
            "000.000.000-03",
            "Test",
            "email@exemplo.com"
        );

        $repositorioAluno = new RepositorioDeAlunoEmMemoria();
        $matriculaAluno = new MatricularAluno($repositorioAluno);
        $matriculaAluno->executar($matriculaAlunoDto);

        $aluno = $repositorioAluno->buscarPorCpf(new Cpf($matriculaAlunoDto->cpf));

        $this->assertSame($matriculaAlunoDto->nome, $aluno->nome());
        $this->assertSame($matriculaAlunoDto->email, $aluno->email());
        $this->assertEmpty($aluno->telefones());
    }
}
