<?php

use Arquitetura\Dominio\Aluno\Aluno;
use Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use Arquitetura\Infra\Conexao\ConexaoPDO;

require_once './../vendor/autoload.php';

$conexao = ConexaoPDO::criar();

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$dd = $argv[4];
$numero = $argv[5];

$aluno = Aluno::comCpfNomeEEmail(
    $cpf,
    $nome,
    $email
)->adicionarTelefone($dd, $numero);

$repositorio = new RepositorioDeAlunoEmMemoria();
$repositorio->adicionar($aluno);

echo 'Aluno Criado';
