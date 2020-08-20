<?php 
  include('cabecalho.php');
  require_once('pagina-protegida.php');
  require_once('conecta.php');
  require_once('funcoes-categoria-banco.php');

  function CortaDescricao($descricao)
  {
      return strlen($descricao) > 200 ? substr($descricao,0,200) . '...' : $descricao;
  }
?>

<div class="jumbotron text-center">
    <h1 class="display-6">Lista de Categorias</h1>
    <p>Categorias Cadastradas</p>
</div>

<?php if(array_key_exists('removido', $_GET) && $_GET['removido'] == true) : ?>
    <p class="alert alert-success">Categoria deletada!</p>
<?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
    <?php $categorias = ListaCategorias($conexao) ?>
    <?php foreach($categorias as $categoria) : ?>
        <tr>
            <td><?= $categoria['id'] ?></td>
            <td><?= $categoria['nome'] ?></td>
            <td>
                <form action="remove-categoria.php" method="post">
                    <input type="hidden" name="id" value="<?= $categoria['id'] ?>" />
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include('rodape.php'); ?>