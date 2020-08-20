<?php

require_once('classes/Categoria.php');
require_once('classes/Produto.php');

function InsereProduto($conexao, Produto $produto)
{
    $produto->setNome(mysqli_real_escape_string($conexao,$produto->getNome())); // *** Efetua o tratamento de caracteres especiais ***
    $produto->setDescricao(mysqli_real_escape_string($conexao,$produto->getDescricao()));

    $comando = "INSERT INTO produtos(";
    $comando = $comando . "nome, ";
    $comando = $comando . "preco, ";
    $comando = $comando . "descricao, ";
    $comando = $comando . "categoria_id, ";
    $comando = $comando . "usado ";
    $comando = $comando . ") ";
    $comando = $comando . "VALUES(";
    $comando = $comando . "'{$produto->getNome()}', ";
    $comando = $comando . "{$produto->getPreco()}, ";
    $comando = $comando . "'{$produto->getDescricao()}', ";
    $comando = $comando . "{$produto->getCategoria()->getId()}, "; 
    $comando = $comando . "{$produto->getUsado()})";

    return mysqli_query($conexao, $comando);
}

function ListaProdutos($conexao,$ordem = 'D',$pagina = '0')
{
    $listaDeProdutos = array();
 
    $comando   = 'SELECT p.*, c.nome AS categoria FROM produtos AS p ';
    $comando   = $comando . 'LEFT JOIN categorias AS c ON (p.categoria_id = c.id) ';
    $comando   = $comando . 'ORDER BY id ';    
    $comando   = $comando . (($ordem == 'A') ? 'ASC' : 'DESC') . ' ';
    $comando   = $comando . 'LIMIT ' . $pagina . ',3';
   
    $resultado = mysqli_query($conexao, $comando);    

    while($produto = mysqli_fetch_object($resultado)):
        $c = new Categoria;
        $c->setNome($produto->categoria);

        $p = new Produto($produto->nome, $produto->preco);

        $p->setID($produto->id);
        $p->setNome($produto->nome);
        $p->setDescricao($produto->descricao);
        $p->setPreco($produto->preco);
        $p->setUsado($produto->usado);
        $p->setCategoria($c);

        array_push($listaDeProdutos, $p);
    endwhile;

    return $listaDeProdutos;
}

function RemoveProduto($conexao, $id)
{
    $comando = "DELETE FROM produtos WHERE id = {$id}";
    return mysqli_query($conexao, $comando);
}

function QtdeProdutos($conexao)
{
    $comando = "SELECT * FROM produtos";

    $resultado = mysqli_query($conexao, $comando);
    
    return mysqli_num_rows($resultado);
}

function BuscaProdutos($conexao,$id)
{
    $listaDeProdutos = array();
 
    $comando   = "SELECT p.*, c.nome AS categoria FROM produtos AS p ";
    $comando   = $comando . "LEFT JOIN categorias AS c ON (p.categoria_id = c.id) ";
    $comando   = $comando . "WHERE p.id = {$id}";
   
    $resultado = mysqli_query($conexao, $comando);    
    $produto   = mysqli_fetch_object($resultado);

    $c = new Categoria;
    $c->setNome($produto->categoria);
    $c->setId($produto->categoria_id);

    $p = new Produto($produto->nome, $produto->preco);

    $p->setID($produto->id);
    $p->setNome($produto->nome);
    $p->setDescricao($produto->descricao);
    $p->setPreco($produto->preco);
    $p->setUsado($produto->usado);
    $p->setCategoria($c);

    return $p;
}

function AlteraProduto($conexao, Produto $produto)
{
    $produto->setNome(mysqli_real_escape_string($conexao,$produto->getNome())); // *** Efetua o tratamento de caracteres especiais ***
    $produto->setDescricao(mysqli_real_escape_string($conexao,$produto->getDescricao()));

    $comando = "UPDATE produtos SET ";
    $comando = $comando . "nome = '{$produto->getNome()}', ";
    $comando = $comando . "preco = {$produto->getPreco()}, ";
    $comando = $comando . "descricao = '{$produto->getDescricao()}', ";
    $comando = $comando . "categoria_id = {$produto->getCategoria()->getId()}, ";
    $comando = $comando . "usado = {$produto->getUsado()} ";
    $comando = $comando . "WHERE id = {$produto->getId()}";

    return mysqli_query($conexao, $comando);
}