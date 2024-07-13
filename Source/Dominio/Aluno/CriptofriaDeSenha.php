<?php

namespace Arquitetura\Dominio\Aluno;

interface CriptofriaDeSenha
{
    public function criptografar(string $senha): string;

    public function verificar(string $senhaEmTexto, string $senhaCriptografada): bool;
}
