<?php 

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
   

    session_start(); 
    require_once('usuario-sessao.php');
    require_once('autoloader.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Minha loja</title>
        <!-- 1. Baixar o BootStrap em: getbootstrap.com -->
        <!-- 2. Descompactar na pasta loja, deixar só o 
             css/bootstrap.min.css e o js/bootstrap.min.js -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Loja PHP8411</a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <?php if(UsuarioEstaLogado()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="lista-produto.php">Lista de Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produto-formulario.php">Cadastro de Produtos</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php if(UsuarioEstaLogado()) : ?>
                            <a class="nav-link" href="logout.php">Logout</a>
                        <?php else : ?>
                            <a class="nav-link" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
    <div class="container">