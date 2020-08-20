<?php

class BancoDeDados
{
    private static $conexao;

    function __construct()
    {
        if(!self::$conexao)
        {
            self::$conexao = mysqli_connect('127.0.0.1','root','liberar7777','loja8411'); 
        }
    }

    public function conectar()
    {
        return self::$conexao;
    }
}