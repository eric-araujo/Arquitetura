<?php

namespace Arquitetura\Infra\Aluno;

use Arquitetura\Dominio\Aluno\Aluno;
use Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Arquitetura\Infra\Aluno\Exception\AlunoNaoEncontradoException;

class RepositorioDeAlunoPDO implements RepositorioDeAluno
{
    private \PDO $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adicionar(Aluno $aluno): int
    {
        $insertAluno = <<<SQL
            INSERT INTO tb_alunos VALUES (:cpf, :nome, :email);
        SQL;

        $stmt = $this->conexao->prepare($insertAluno);
        $stmt->bindValue(':cpf', $aluno->cpf());
        $stmt->bindValue(':nome', $aluno->nome());
        $stmt->bindValue(':email', $aluno->email());
        $stmt->execute();

        $insertTelefone = <<<SQL
            INSERT INTO tb_telefones VALUES (:ddd, :numero, :cpf_aluno);
        SQL;

        $stmt = $this->conexao->prepare($insertTelefone);
        foreach ($aluno->telefones() as $telefone) {
            $stmt->bindValue(':ddd', $telefone->ddd());
            $stmt->bindValue(':numero', $telefone->numero());
            $stmt->bindValue(':cpf_aluno', $aluno->cpf());
            $stmt->execute();
        }

        return $this->conexao->lastInsertId();
    }

    public function buscarPorCpf(\Arquitetura\Dominio\Cpf $cpf): Aluno
    {
        $select = <<<SQL
            SELECT a.cpf, a.nome, a.email, t.ddd, t.numero 
            FROM tb_alunos a
            LEFT JOIN tb_telefones t ON t.cpf_aluno = a.cpf
            WHERE a.cpf = :cpf;
        SQL;

        $query = $this->conexao->prepare($select);
        $query->bindValue(':cpf', $cpf);
        $query->execute();
        $dadosAlunos = $query->fetchAll();

        if (empty($dadosAlunos)) {
            throw new AlunoNaoEncontradoException($cpf);
        }

        return $this->montarAluno($dadosAlunos);
    }

    public function buscarTodos(): array
    {
        $select = <<<SQL
            SELECT a.cpf, a.nome, a.email, t.ddd, t.numero 
            FROM tb_alunos a
            LEFT JOIN tb_telefones t ON t.cpf_aluno = a.cpf;
        SQL;

        $resultado = $this->conexao->query($select);
        $listaDeAlunos = $resultado->fetchAll();

        $alunos = [];
        foreach ($listaDeAlunos as $dadosAluno) {
            $cpfAluno = $dadosAluno['cpf'];
            if (!array_key_exists($cpfAluno, $alunos)) {
                $alunos[$cpfAluno] = Aluno::comCpfNomeEEmail(
                    $cpfAluno,
                    $dadosAluno['nome'],
                    $dadosAluno['email']
                );
            }

            $alunos[$cpfAluno]->adicionarTelefone($dadosAluno['ddd'], $dadosAluno['numero']);
        }

        return array_values($alunos);
    }

    private function montarAluno(array $dadosAlunos): Aluno
    {
        $aluno = null;

        foreach ($dadosAlunos as $index => $dadosAluno) {
            if ($index === 0) {
                $aluno = Aluno::comCpfNomeEEmail(
                    $dadosAluno['cpf'],
                    $dadosAluno['nome'],
                    $dadosAluno['email']
                );
            }

            $aluno->adicionarTelefone(
                $dadosAluno['ddd'],
                $dadosAluno['numero']
            );
        }

        return $aluno;
    }
}
