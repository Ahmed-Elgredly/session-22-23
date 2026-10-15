<?php 

/** 
 * @var array $total
*/

?>

<div class="item bg-light px-3 py-4 rounded-4 position-relative">

    <button type="button" class="btn bg-primary-subtle text-primary-emphasis position-absolute" style="top:20px; right:20px;" onclick="getItemsIntoCart()">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <span id="totalItems"><?= $total['totalItemsInCart'] ?></span>
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>

    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" id="statistics-tab-pane" role="presentation">
            <button class="nav-link active" id="nav-statistics-tab" data-bs-toggle="tab" data-bs-target="#nav-statistics" type="button" role="tab" aria-controls="nav-statistics" aria-selected="true">Statistics</button>
        </li>
        <!-- <li class="nav-item" id="admins-tab-pane" role="presentation">
            <button class="nav-link" id="nav-admins-tab" data-bs-toggle="tab" data-bs-target="#nav-admins" type="button" role="tab" aria-controls="nav-admins" aria-selected="true">Admins</button>
        </li>
        <li class="nav-item" id="customers-tab-pane" role="presentation">
            <button class="nav-link" id="nav-customers-tab" data-bs-toggle="tab" data-bs-target="#nav-customers" type="button" role="tab" aria-controls="nav-customers" aria-selected="false">Customers</button>
        </li>
        <li class="nav-item" id="authors-tab-pane" role="presentation">
            <button class="nav-link" id="nav-authors-tab" data-bs-toggle="tab" data-bs-target="#nav-authors" type="button" role="tab" aria-controls="nav-authors" aria-selected="false">Authors</button>
        </li> -->
        <li class="nav-item" id="books-tab-pane" role="presentation">
            <button class="nav-link" id="nav-books-tab" data-bs-toggle="tab" data-bs-target="#nav-books" type="button" role="tab" aria-controls="nav-books" aria-selected="false">Books</button>
        </li>
        <li class="nav-item" id="orders-tab-pane" role="presentation">
            <div class="dropdown">
                <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Orders
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" id="nav-orders_ordered-tab" data-bs-toggle="tab" data-bs-target="#nav-orders_ordered" type="button" role="tab" aria-controls="nav-orders_ordered" aria-selected="false">Ordered</a></li>
                    <li><a class="dropdown-item" id="nav-orders_canceled-tab" data-bs-toggle="tab" data-bs-target="#nav-orders_canceled" type="button" role="tab" aria-controls="nav-orders_canceled" aria-selected="false">Canceled</a></li>
                    <li><a class="dropdown-item" id="nav-orders_done-tab" data-bs-toggle="tab" data-bs-target="#nav-orders_done" type="button" role="tab" aria-controls="nav-orders_done" aria-selected="false">Done</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="nav-statistics" role="tabpanel" aria-labelledby="nav-statistics-tab" tabindex="0">
            <?php include __DIR__ . "/statistics-cards.php"; ?>
        </div>
        <!-- <div class="tab-pane fade show " id="nav-admins" role="tabpanel" aria-labelledby="nav-admins-tab" tabindex="0">
            <?php include __DIR__ . "/admins_cards.php"; ?>
        </div>
        <div class="tab-pane fade" id="nav-customers" role="tabpanel" aria-labelledby="nav-customers-tab" tabindex="0">
            <?php include __DIR__ . "/customers_cards.php"; ?>
        </div>
        <div class="tab-pane fade show" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab" tabindex="0">
            <button class="btn btn-success w-100 mb-3" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
                Add Author
            </button>
            <?php include __DIR__ . "/authors_cards.php"; ?>
        </div> -->
        <div class="tab-pane fade show" id="nav-books" role="tabpanel" aria-labelledby="nav-books-tab" tabindex="0">
            <div id="BooksFilter">
                <form id="BooksFilterForm">
                    <input type="hidden" name="page" value="1" id="StartPage">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterBookTitle" class="input-group-text" id="basic-addon1">@</label>
                                <input type="text" id="FilterBookTitle" class="form-control" placeholder="Title..." name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterBookAuthor" class="input-group-text" id="basic-addon1">@</label>
                                <input type="text" id="FilterBookAuthor" class="form-control" placeholder="Author..." name="author">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterMinPrice" class="input-group-text" id="basic-addon1">@</label>
                                <input type="text" id="FilterMinPrice" class="form-control" placeholder="Min Price..." name="minPrice">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterMaxPrice" class="input-group-text" id="basic-addon1">@</label>
                                <input type="text" id="FilterMaxPrice" class="form-control" placeholder="Max Price..." name="maxPrice">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterStock" class="input-group-text" id="basic-addon1">@</label>
                                <input type="text" id="FilterStock" class="form-control" placeholder="Stock..." name="stock">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <label for="FilterSort" class="input-group-text" id="basic-addon1">@</label>
                                <select id="FilterSort" class="form-control" name="sort">
                                    <option value="DESC">↑ DESC</option>
                                    <option value="ASC">↓ ASC</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success m-2 w-100">Filter</button>
                </form>
            </div>
            <?php include __DIR__ . "/books_cards.php"; ?>
        </div>
        <div class="tab-pane fade" id="nav-orders_ordered" role="tabpanel" aria-labelledby="nav-orders_ordered-tab" tabindex="0">
            <?php include __DIR__ . "/orders_ordered_tables.php" ?>
        </div>
        <div class="tab-pane fade" id="nav-orders_canceled" role="tabpanel" aria-labelledby="nav-orders_canceled-tab" tabindex="0">
            <?php include __DIR__ . "/orders_canceled_tables.php" ?>
        </div>
        <div class="tab-pane fade" id="nav-orders_done" role="tabpanel" aria-labelledby="nav-authors-tab" tabindex="0">
            <?php include __DIR__ . "/orders_done_tables.php" ?>
        </div>
    </div>
</div>