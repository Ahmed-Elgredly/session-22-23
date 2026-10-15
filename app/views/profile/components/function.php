<?php

function preparePagination(array $data, string $type)
{
    if (!empty($data['data'])) {

        $prepareLi = "";
        $pagesNumber = ceil($data['total'] / 10);
        $prevPageNumber = ($data['currentPage'] > 1) ? $data['currentPage'] - 1 : 1;
        $isPrevPageDisabled = ($data['currentPage'] > 1) ? '' : 'disabled';
        $nextPageNumber = ($data['currentPage'] < $pagesNumber) ? $data['currentPage'] + 1 : $pagesNumber;
        $isNextPageDisabled = ($data['currentPage'] < $pagesNumber) ? '' : 'disabled';

        $profileLink = route('/profile');

        for ($i = 1; $i <= $pagesNumber; $i++) {
            $isActive = ($data['currentPage'] == $i) ? 'active' : '';
            $prepareLi .= "<li class='page-item {$isActive}'><a class='page-link' href='{$profileLink}?{$type}-page={$i}' >{$i}</a></li>";
        }

        echo "
            <nav id = 'nav-book-filter' aria-label='Page navigation example'>
                <ul class='pagination'>
                    <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href='{$profileLink}?{$type}-page={$prevPageNumber}'>Previous</a></li>
                    {$prepareLi}
                    <li class='page-item'><a class='page-link {$isNextPageDisabled}' href='{$profileLink}?{$type}-page={$nextPageNumber}'>Next</a></li>
                </ul>
            </nav>
        ";
    }

    echo "";
}
