<?php

namespace Arquitetura;

class Indicacao
{
    private Aluno $indicante;
    private Aluno $indicado;
    private \DateTimeImmutable $data;

    public function __construct(Aluno $indicante, Aluno $indicado)
    {
        $this->indicado = $indicante;
        $this->indicado = $indicado;

        $this->data = new \DateTimeImmutable();
    }
}