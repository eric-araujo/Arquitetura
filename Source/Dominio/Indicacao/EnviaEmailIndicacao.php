<?php

namespace Arquitetura\Dominio\Indicacao;

use Arquitetura\Dominio\Aluno\Aluno;

interface EnviaEmailIndicacao
{
    public function enviar(Aluno $alunoIndicado): void;
}
