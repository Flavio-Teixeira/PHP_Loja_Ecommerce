<?php
    $qtdeProdutos = $ProdutoDAO->QtdeProdutos();
    $paginas = (($qtdeProdutos % 3) > 0 ? (intval($qtdeProdutos / 3) + 1) : intval($qtdeProdutos / 3));
?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="?pagina=<?= (($pagina-1) <= 0 ? 1 : ($pagina-1)) ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="page-item"><a class="page-link <?= ($i == $pagina) ? 'text-danger' : '' ?>" href="?pagina=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>
    <li class="page-item">
      <a class="page-link" href="?pagina=<?= (($pagina+1) > $paginas ? $paginas : ($pagina+1)) ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>