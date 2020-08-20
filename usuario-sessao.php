<?php

function UsuarioEstaLogado()
{
    return isset($_SESSION['usuario_logado']);
}