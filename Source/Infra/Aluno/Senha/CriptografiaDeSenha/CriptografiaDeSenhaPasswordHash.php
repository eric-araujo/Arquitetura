<?php

namespace Arquitetura\Infra\Aluno\Senha\CriptografiaDeSenha;

use Arquitetura\Dominio\Aluno\CriptofriaDeSenha;

class CriptofriaDeSenhaPasswordHash implements CriptofriaDeSenha
{
    public function criptografar(string $senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2ID);
    }

    public function verificar(string $senhaEmTexto, string $senhaCriptografada): bool
    {
        return password_verify($senhaEmTexto, $senhaCriptografada);
    }
}
