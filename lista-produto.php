<?php 
  include('cabecalho.php');
  require_once('pagina-protegida.php');

  $BancoDeDados = new BancoDeDados();  
  $ProdutoDAO   = new ProdutoDAO($BancoDeDados->conectar());
?>

<div class="jumbotron text-center">
    <h1 class="display-6">Lista de Produtos</h1>
    <p>Produtos Cadastrados</p>
</div>

<?php if(array_key_exists('removido', $_GET) && $_GET['removido'] == true) : ?>
    <p class="alert alert-success">Produto deletado!</p>
<?php endif; ?>

<?php 
    $pagina = (isset($_GET['pagina']) ? $_GET['pagina'] : 1);
    $produtos = $ProdutoDAO->listaTodos(null,(($pagina - 1) * 3));

    require_once('paginacao.php');  
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-right">#ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Usado</th>
            <th>Descrição</th>
            <th class="text-right">Preço</th>
            <th class="text-center" colspan="2">Opções</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($produtos as $p) : ?>
        <tr>
            <td class="text-right"><?= $p->getID() ?></td>
            <td><?= $p->getNome() ?></td>
            <td><?= $p->getCategoria() ?></td>
            <td><?= $p->getUsado() == true ? 'Sim' : 'Não' ?></td>
            <td><?= $p->getDescricaoResumida() ?></td>
            <td class="text-right"><?= 'R$ ' . $p->getPreco() ?></td>
            <td class="text-center"> 
                <form action="remove-produto.php" method="post">
                    <input type="hidden" name="id" value="<?= $p->getID() ?>" />
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
            <td class="text-center">
                <a class="btn btn-primary" href="produto-formulario.php?id=<?= $p->getID() ?>">Alterar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include('rodape.php'); ?>