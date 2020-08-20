<?php 
  session_start(); 
  require_once('usuario-sessao.php');
  require_once('autoloader.php');
  require_once('pagina-protegida.php');

  $BancoDeDados = new BancoDeDados();  
  $ProdutoDAO   = new ProdutoDAO($BancoDeDados->conectar());

  $id = $_POST['id'];

  if($ProdutoDAO->remove($id))
  {
      header('location: lista-produto.php?removido=true');
      die();
  }  