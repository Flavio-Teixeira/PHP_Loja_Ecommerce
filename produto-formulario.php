<?php 
    include('cabecalho.php');
    require_once('pagina-protegida.php');

    $BancoDeDados = new BancoDeDados();  
    $ProdutoDAO   = new ProdutoDAO($BancoDeDados->conectar());
    $CategoriaDAO = new CategoriaDAO($BancoDeDados->conectar());
  
    $categorias = $CategoriaDAO->listaTodas();
    $titulo     = "Cadastrar";
    $acao       = "adiciona-produto.php";
    $categoria  = new Categoria;
    $produto    = new Produto('','');
    $produto->setCategoria($categoria);

    if(array_key_exists('id', $_GET))
    {
        $titulo  = "Alterar";
        $acao    = "altera-produto.php";
        $produto = $ProdutoDAO->busca($_GET['id']);  
    }
  ?>
  
    <div class="jumbotron text-center">
        <h1 class="display-6">Produto</h1>
        <p><?= $titulo; ?> Produto</p>
    </div>

    <form action="<?= $acao; ?>" method="post">
        <fieldset>
            <legend>Dados necessários</legend>

            <input type="hidden" name="produto_id" value="<?= $produto->getId(); ?>">

            <div class="form-group">
                <label>Nome: </label>
                <input type="text" name="nome" aria-describedby="nome" placeholder="Informe seu nome" value="<?= $produto->getNome(); ?>">
                <small id="nome" class="form-text text-muted">Nome completo</small>
            </div>

            <div class="form-group">
                <label>Preço: </label>
                <input type="text" name="preco" aria-describedby="preco" placeholder="0.00" value="<?= $produto->getPreco(); ?>">
                <small id="preco" class="form-text text-muted">Preço em reais (R$)</small>
            </div>

            <div class="form-group">
                <label>Categoria: </label>
                <select name="categoria_id" class="form-control">
                    <?php foreach($categorias as $categoria) : ?>
                        <?php if($categoria->getId() == $produto->getCategoria()->getId()) : ?>
                            <option value="<?= $categoria->getId() ?>" selected>
                        <?php else : ?>
                            <option value="<?= $categoria->getId() ?>">
                        <?php endif; ?>
                            
                        <?= $categoria->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Usado: </label>
                <input type="radio" name="usado" value="S" <?= $produto->getUsado() == true ? 'checked="true"' : 'checked="false"'; ?>>Sim
                <input type="radio" name="usado" value="N" <?= $produto->getUsado() == false ? 'checked="true"' : 'checked="false"'; ?>>Não
            </div>

            <div class="form-group">
                <label>Descrição: </label>
                <textarea name="descricao" placeholder="Informar a descrição completa do produto" class="form-control">
                    <?= $produto->getDescricao(); ?>
                </textarea>
                <small id="descricao" class="form-text text-muted">Descrição do produto</small>
            </div>

            <button type="submit" class="btn btn-primary"><?= $titulo; ?></button>
        </fieldset>    
    </form>

<?php include('rodape.php') ?>