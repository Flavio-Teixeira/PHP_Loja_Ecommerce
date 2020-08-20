<?php

class Produto
{
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $usado;
    private $categoria;

    public function __construct($nome, $preco)
    {
        $this->setNome($nome);
        $this->setPreco($preco);
    }

    public function setID($valor)
    {
        $this->id = $valor;
    }

    public function getID()
    {
        return $this->id;
    } 

    public function setNome($texto)
    {
        if($texto != '')
        {
            $this->nome = $texto;
        }        
    }

    public function getNome()
    {
        return $this->nome;
    } 

    public function setDescricao($texto)
    {
        $this->descricao = $texto;
    }

    public function getDescricao()
    {
        return $this->descricao;
    } 

    public function setPreco($valor)
    {
        if($valor >= 0)
        {
            $this->preco = $valor;
        }        
    }

    public function getPreco()
    {
        return $this->preco;
    } 

    public function setUsado($texto)
    {
        $this->usado = $texto;
    }

    public function getUsado()
    {
        return $this->usado;
    } 

    public function setCategoria(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    } 

    public function __toString()
    {
        return "{$this->nome}, {$this->preco}";
    }

    public function getDescricaoResumida()
    {
        return strlen($this->descricao) > 200 
               ? substr($this->descricao,0,200) . '...' 
               : $this->descricao;
    }
}