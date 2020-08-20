<?php 
    include('cabecalho.php');
    require_once('usuario-sessao.php');

    $BancoDeDados = new BancoDeDados();  
    $UsuarioDAO   = new UsuarioDAO($BancoDeDados->conectar());

    if( isset($_POST['email']) && isset($_POST['senha']) )
    {
        $usuario = $UsuarioDAO->buscaUsuario($_POST['email']);

        if(password_verify($_POST['senha'], $usuario['senha']))
        {
            $_SESSION['usuario_logado'] = $usuario['email'];
            header('Location: lista-produto.php');
        }
    } 
  ?>
  
    <div class="jumbotron text-center">
        <h1 class="display-6">Login</h1>
        <p>Efetuar o Login</p>
    </div>

    <?php if(UsuarioEstaLogado()) : ?>
        <p class="alert alert-primary mt-1">Você já está logado no Sistema!</p>
    <?php else : ?>
        <form method="post">
            <fieldset>
                <legend>Dados para login</legend>

                <div class="form-group">
                    <label>e-mail: </label>
                    <input type="text" name="email" aria-describedby="email" placeholder="Informe o seu e-mail aqui...">
                    <small id="email" class="form-text text-muted">Informe o seu e-mail</small>
                </div>

                <div class="form-group">
                    <label>Senha: </label>
                    <input type="password" name="senha" aria-describedby="senha">
                    <small id="senha" class="form-text text-muted">Informe uma senha diferente do seu e-mail</small>
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button>
            </fieldset>    
        </form>
    <?php endif ?>

<?php include('rodape.php') ?>