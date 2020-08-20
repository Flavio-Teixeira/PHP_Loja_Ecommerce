<?php 

function BuscaUsuario($conexao,$email)
{
    $comando   = "SELECT * FROM usuarios WHERE email = '{$email}'";
    $resultado = mysqli_query($conexao, $comando);

    return mysqli_fetch_assoc($resultado);
}