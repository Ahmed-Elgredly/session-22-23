<?php

/**
 * @var array $books
 */

?>

<div class="row">

    <?php
    if (!empty($books['data'])) {

        foreach ($books['data'] as $book) {

            $bookImg = asset('/images/' . ($book['image'] ? 'uploads/' . $book['image'] : 'book.png'));
            $shortDiscription  = substr($book['description'], 0, 100);
            $buttonOrder = "" ;
            
            
            if(isAuth('customer')){
                $buttonOrder = "<div class='input-group'>
                                <input type='number' min='1' class='form-control' placeholder='Quantity' id='input_quantity_{$book['id']}' >
                                <button class='btn btn-outline-success' type='button' onclick= 'addToCart({$book['id']}, this)' >Added To Cart</button>
                            </div>";
            }

            echo "
                    <div class='col-lg-4 mb-3'>
                        <div class='item'>
                            <div class='card px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                                <img src='{$bookImg}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                                <div class='card-body pb-0'>
                                    <h5 class='card-title mb-4 text-center'> {$book['title']}</h5>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Author :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$book['author_name']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Description :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>$shortDiscription</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> price :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$book['price']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'>Stock :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$book['stock']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    {$buttonOrder}
                                </div>
                            </div>
                        </div>
                    </div>
                ";
        }
    } else {
        echo "<p class='alert alert-warning w-75 m-auto text-center'>There are no books</p>";
    }
    ?>

</div>

<?php
preparePagination($books, 'books');
?>