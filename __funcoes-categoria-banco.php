<?php

require_once('classes/Categoria.php');

function InsereCategorias($conexao, $nome)
{
    $comando = "INSERT INTO categorias(nome) VALUES('{$nome}')";
    return mysqli_query($conexao, $comando);
}

function ListaCategorias($conexao,$ordem = 'A')
{
    $listaDeCategorias = array();

    $comando   = 'SELECT * FROM categorias ORDER BY nome ';
    $comando   = $comando . (($ordem == 'A') ? 'ASC' : 'DESC');
   
    $resultado = mysqli_query($conexao, $comando);    

    while($categoria = mysqli_fetch_object($resultado)):
        $c = new Categoria;
        $c->setId($categoria->id);
        $c->setNome($categoria->nome);

        array_push($listaDeCategorias, $c);
    endwhile;

    return $listaDeCategorias;
}

function RemoveCaegorias($conexao, $id)
{
    $comando = "DELETE FROM categorias WHERE id = {$id}";
    return mysqli_query($conexao, $comando);
}