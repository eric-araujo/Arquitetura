<?php

$pdo = new \PDO(
    'sqlite:' . __DIR__ . '/banco.sqlite'
);

echo 'Conectado!';

$pdo->exec(file_get_contents(__DIR__ . '/banco.sql'));
