<?php

/**
 * @var array $authors
 */

?>

<div class="row">

    <?php
    if (!empty($authors['data'])) {

        foreach ($authors['data'] as $author) {

            $authorImg = asset('/images/author.png');
            $shortBio  = substr($author['bio'], 0, 100);

            echo "
                    <div class='col-lg-4 mb-3'>
                        <div class='item'>
                            <div class='card px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                                <img src='{$authorImg}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                                <div class='card-body'>

                                    <h5 class='card-title mb-4 text-center'> {$author['name']}</h5>

                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> BIO :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$shortBio}...</P>
                                            </div>
                                        </div>
                                    </div>

                                    <button class='btn btn-success w-100 mb-3' onclick='openAddBookPopup({$author['id']}, \"{$author["name"]}\")'>
                                        Add Book
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
        }
    } else {
        echo "<p class='alert alert-warning w-75 m-auto text-center'>There are no authors</p>";
    }
    ?>

</div>

<?php

preparePagination($authors, 'authors');

?>