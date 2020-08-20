<?php 
  include('cabecalho.php');
  require_once('pagina-protegida.php');

  $BancoDeDados = new BancoDeDados();  
  $ProdutoDAO   = new ProdutoDAO($BancoDeDados->conectar());
?>
        <div class="jumbotron text-center">
          <h1 class="display-6">Produto</h1>
          <p>Alterar Produto</p>
        </div>

        <?php
            $categoria = new Categoria; 
            $categoria->setId($_POST['categoria_id']);

            $produto = new Produto($_POST['nome'], $_POST['preco']);

            $produto->setId($_POST['produto_id']);
            $produto->setDescricao($_POST['descricao']);
            $produto->setCategoria($categoria);
            $produto->setUsado($_POST['usado'] == 'N' ? 'false' : 'true'); 
        ?>

        <?php if($ProdutoDAO->altera($produto)) : ?>
              <p class="alert alert-success">
                O produto <?= $produto->getNome(); ?>, <?= $produto->getPreco(); ?> foi alterado com sucesso.
              </p>
        <?php else : ?>
              <p class="alert alert-danger">
                O produto <?= $produto->getNome(); ?> não foi salvo!! <?= mysqli_error($conexao); ?>
              </p>
        <?php endif; ?>

<?php include('rodape.php') ?>