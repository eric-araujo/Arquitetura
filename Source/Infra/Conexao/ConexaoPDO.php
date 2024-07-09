<?php

namespace Arquitetura\Infra\Conexao;

use PDO;

class ConexaoPDO
{
    private static $conexao = null;

    public static function criar(): PDO
    {
        if (is_null(self::$conexao)) {
            self::$conexao = new PDO(
                'sqlite:' . __DIR__ . '/../../../banco.sqlite'
            );
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$conexao;
    }
}
