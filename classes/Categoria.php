<?php 

class Categoria
{
    private $id;
    private $nome;

    public function setId($valor)
    {
        $this->id = $valor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($texto)
    {
        $this->nome = $texto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function __toString()
    {
        return $this->nome;
    }
}