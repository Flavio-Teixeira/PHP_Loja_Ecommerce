<?php

class CategoriaDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function salva($nome)
    {
        $comando = "INSERT INTO categorias(nome) VALUES('{$nome}')";
        return mysqli_query($this->conexao, $comando);
    }

    public function listaTodas($ordem = 'A')
    {
        $listaDeCategorias = array();

        $comando   = 'SELECT * FROM categorias ORDER BY nome ';
        $comando   = $comando . (($ordem == 'A') ? 'ASC' : 'DESC');
    
        $resultado = mysqli_query($this->conexao, $comando);    

        while($categoria = mysqli_fetch_object($resultado)):
            $c = new Categoria;
            $c->setId($categoria->id);
            $c->setNome($categoria->nome);

            array_push($listaDeCategorias, $c);
        endwhile;

        return $listaDeCategorias;
    }

    public function remove($id)
    {
        $comando = "DELETE FROM categorias WHERE id = {$id}";
        return mysqli_query($this->conexao, $comando);
    }
}