<?php

namespace Arquitetura\Dominio\Aluno;

use Arquitetura\Dominio\Cpf;
use Arquitetura\Dominio\Email;
use Arquitetura\Dominio\Telefone;

class Aluno
{
    private string $nome;
    private Cpf $cpf;
    private Email $email;
    private array $telefones;

    public static function comCpfNomeEEmail(string $cpf, string $nome, string $email): self
    {
        return new Aluno(
            new Cpf($cpf),
            $nome,
            new Email($email)
        );
    }

    public function __construct(Cpf $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function adicionarTelefone(string $ddd, string $numero): self
    {
        $this->telefones[] = new Telefone($ddd, $numero);

        return $this;
    }
}
