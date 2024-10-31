<?php
/** @var App\Models\Paginator $paginator */
?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link <?= $paginator->isFirstPage() ? 'disabled' : '' ?>"
               href="?page=<?= $paginator->firstPage() ?>" title="Első">&laquo;</a>
        </li>
        <li class="page-item">
            <a class="page-link <?= $paginator->hasPreviousPage() ? '' : 'disabled' ?>"
               href="?page=<?= $paginator->previousPage() ?>" title="Előző">&lt;</a>
        </li>

        <?php for ($i = $paginator->start(); $i <= $paginator->end(); $i++): ?>
            <li class="page-item <?= $i == $paginator->currentPage() ? 'active' : '' ?>">
                <?php if ($i == $paginator->currentPage()): ?>
                    <span class="page-link"><?= $i ?></span>
                <?php else: ?>
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <li class="page-item">
            <a class="page-link <?= $paginator->hasNextPage() ? '' : 'disabled' ?>"
               href="?page=<?= $paginator->nextPage() ?>" title="Következő">&gt;</a>
        </li>

        <li class="page-item">
            <a class="page-link <?= $paginator->isLastPage() ? 'disabled' : '' ?>"
               href="?page=<?= $paginator->lastPage() ?>" title="Utolsó">&raquo;</a>
        </li>
    </ul>
</nav>