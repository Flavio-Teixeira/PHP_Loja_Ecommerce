<?php

class UsuarioDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    function buscaUsuario($email)
    {
        $comando   = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($this->conexao, $comando);

        return mysqli_fetch_assoc($resultado);
    }
}