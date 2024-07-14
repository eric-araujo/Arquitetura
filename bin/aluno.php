<?php

use Arquitetura\Dominio\Aluno\Aluno;
use Arquitetura\Dominio\Cpf;
use Arquitetura\Infra\Aluno\RepositorioDeAlunoPDO;
use Arquitetura\Infra\Conexao\ConexaoPDO;

require_once './../vendor/autoload.php';

$conexao = ConexaoPDO::criar();

if (!is_null($conexao)) {
    echo 'Conectado' . PHP_EOL;
}

$comando = $argv[1];

if ($comando == 'cadastrar') {
    $aluno = Aluno::comCpfNomeEEmail(
        '000.000.000-20',
        'Rodolfo',
        'rodolfo@hotmail.com'
    );
    $aluno->adicionarTelefone('99', '99992312');
    $aluno->adicionarTelefone('11', '4233435435');

    (new RepositorioDeAlunoPDO($conexao))->adicionar($aluno);

    die('Cadastrado');
}

if ($comando == 'buscar-cpf') {
    var_dump((new RepositorioDeAlunoPDO($conexao))->buscarPorCpf(new Cpf('000.000.000-20')));
    die;
}

if ($comando == 'buscar-todos') {
    var_dump((new RepositorioDeAlunoPDO($conexao))->buscarTodos());
    die;
}
