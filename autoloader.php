<?php

spl_autoload_register(function($nomeDaClasse)
{
    $caminhoArquivo = "classes/{$nomeDaClasse}.php";

    if(file_exists($caminhoArquivo))
    {
        require_once($caminhoArquivo);
    }
});