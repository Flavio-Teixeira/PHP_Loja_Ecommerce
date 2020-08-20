<?php

require_once('usuario-sessao.php');

if(!UsuarioEstaLogado())
{
    header('Location: index.php?AcessoNegado');
    die();
}