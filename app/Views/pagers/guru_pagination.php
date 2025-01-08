<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation" class="px-1">
    <ul class="pagination set-flex gap-[3px]">


        <?php $isFirstPage = ($pager->getCurrentPageNumber() == 1); ?>
        <li class="rounded-md hover:bg-light-shadow dark:hover:bg-dark-shadow set-flex <?= $isFirstPage ? 'cursor-not-allowed' : '' ?>">
            <?php if (!$isFirstPage) : ?>
                <a href="<?= generatedPagePaginationUrl('guru', $_GET, 'page') . session()->get('previousPageGuru') ?>" aria-label="<?= lang('Pager.previous') ?>" class="p-2">
            <?php else : ?>
                <span class="p-2">
            <?php endif; ?>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                    </svg>

            <?php if (!$isFirstPage) : ?>
                </a>
            <?php else : ?>
                </span>
            <?php endif; ?>
        </li>

        
        <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="<?= generatedPagePaginationUrl('guru', $_GET, 'page') . $link['title']; ?>" class="rounded-md py-1.5 px-2.5 hover:bg-light-shadow dark:hover:bg-dark-shadow">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>


        <?php $isLastPage = ($pager->getCurrentPageNumber() == $pager->getPageCount()); ?>
        <li class="rounded-md hover:bg-light-shadow dark:hover:bg-dark-shadow set-flex <?= $isLastPage ? 'cursor-not-allowed' : '' ?>">
            <?php if (!$isLastPage) : ?>
                <a href="<?= generatedPagePaginationUrl('guru', $_GET, 'page') . session()->get('nextPageGuru') ?>"
                    aria-label="<?= lang('Pager.next') ?>" class="p-2">
            <?php else : ?>
                <span class="p-2">
            <?php endif; ?>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>

            <?php if (!$isLastPage) : ?>
                </a>
            <?php else : ?>
                </span>
            <?php endif; ?>
        </li>

    </ul>
</nav>