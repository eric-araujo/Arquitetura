<?php

namespace Arquitetura\Infra\Aluno\Senha\CriptografiaDeSenha;

use Arquitetura\Dominio\Aluno\CriptofriaDeSenha;

class CriptofriaDeSenhaMd5 implements CriptofriaDeSenha
{
    public function criptografar(string $senha): string
    {
        return md5($senha);
    }

    public function verificar(string $senhaEmTexto, string $senhaCriptografada): bool
    {
        return md5($senhaEmTexto) === $senhaCriptografada;
    }
}
