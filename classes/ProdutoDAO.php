<?php

class ProdutoDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function salva(Produto $produto)
    {
        $produto->setNome(mysqli_real_escape_string($this->conexao,$produto->getNome())); // *** Efetua o tratamento de caracteres especiais ***
        $produto->setDescricao(mysqli_real_escape_string($this->conexao,$produto->getDescricao()));

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

        return mysqli_query($this->conexao, $comando);
    }

    public function listaTodos($ordem = 'D',$pagina = '0')
    {
        $listaDeProdutos = array();
    
        $comando   = 'SELECT p.*, c.nome AS categoria FROM produtos AS p ';
        $comando   = $comando . 'LEFT JOIN categorias AS c ON (p.categoria_id = c.id) ';
        $comando   = $comando . 'ORDER BY id ';    
        $comando   = $comando . (($ordem == 'A') ? 'ASC' : 'DESC') . ' ';
        $comando   = $comando . 'LIMIT ' . $pagina . ',3';
    
        $resultado = mysqli_query($this->conexao, $comando);    

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

    public function remove($id)
    {
        $comando = "DELETE FROM produtos WHERE id = {$id}";
        return mysqli_query($this->conexao, $comando);
    }

    public function QtdeProdutos()
    {
        $comando = "SELECT * FROM produtos";

        $resultado = mysqli_query($this->conexao, $comando);
        
        return mysqli_num_rows($resultado);
    }

    public function busca($id)
    {
        $listaDeProdutos = array();
    
        $comando   = "SELECT p.*, c.nome AS categoria FROM produtos AS p ";
        $comando   = $comando . "LEFT JOIN categorias AS c ON (p.categoria_id = c.id) ";
        $comando   = $comando . "WHERE p.id = {$id}";
    
        $resultado = mysqli_query($this->conexao, $comando);    
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

    public function altera(Produto $produto)
    {
        $produto->setNome(mysqli_real_escape_string($this->conexao,$produto->getNome())); // *** Efetua o tratamento de caracteres especiais ***
        $produto->setDescricao(mysqli_real_escape_string($this->conexao,$produto->getDescricao()));

        $comando = "UPDATE produtos SET ";
        $comando = $comando . "nome = '{$produto->getNome()}', ";
        $comando = $comando . "preco = {$produto->getPreco()}, ";
        $comando = $comando . "descricao = '{$produto->getDescricao()}', ";
        $comando = $comando . "categoria_id = {$produto->getCategoria()->getId()}, ";
        $comando = $comando . "usado = {$produto->getUsado()} ";
        $comando = $comando . "WHERE id = {$produto->getId()}";

        return mysqli_query($this->conexao, $comando);
    }
}