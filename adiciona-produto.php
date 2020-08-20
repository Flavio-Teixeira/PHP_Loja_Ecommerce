<?php 
  include('cabecalho.php');
  require_once('pagina-protegida.php');

  $BancoDeDados    = new BancoDeDados();  
  $ProdutoDAO      = new ProdutoDAO($BancoDeDados->conectar());
  $EnviadorDeEmail = new EnviadorDeEmail();
?>
        <div class="jumbotron text-center">
          <h1 class="display-6">Produto</h1>
          <p>Adicionar Produto</p>
        </div>

        <?php
            /*
              --- Tutorial para Criação para o BD ---
              1. mysql -u root (-p se precisar de senha)
              2. create database loja;
              3. use loja;
              4. create table produtos(
                  id int primary key auto_increment,
                  nome varchar(255) not null,
                  preco decimal(10,2) not null
              );
              5. select * from produtos;
            */
            $categoria = new Categoria; 
            $categoria->setId($_POST['categoria_id']);

            $produto = new Produto($_POST['nome'], $_POST['preco']);

            $produto->setDescricao($_POST['descricao']);
            $produto->setCategoria($categoria);
            $produto->setUsado($_POST['usado'] == 'N' ? 'false' : 'true'); 
        ?>

        <?php if($ProdutoDAO->salva($produto)) : ?>
              <p class="alert alert-success">
                <?php 
                    $mensagem = "O produto {$produto->getNome()}, {$produto->getPreco()} foi salvo com sucesso.";
                    echo $mensagem;
                ?>
              </p>

              <?php
                  if($EnviadorDeEmail->envia($mensagem))
                  {
                    echo 'E-Mail enviado!';
                  }
              ?>
        <?php else : ?>
              <p class="alert alert-danger">
                O produto <?= $produto->getNome(); ?> não foi salvo!! <?= mysqli_error($conexao); ?>
              </p>
        <?php endif; ?>

<?php include('rodape.php') ?>