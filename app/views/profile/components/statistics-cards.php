<?php 

    /**
     * @var array $total
     */ 

?>

<div class="row">
    <div class="col-lg-3 mb-3">
        <div class="item">
            <div class="card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis">
                <i class="fa-solid m-auto fa-user-group"></i>
                <h6 class="my-3">Total Books</h6>
                <p class="text-success mb-0 fw-bolder"><?= $total['books'] ?></p>
            </div>
        </div>
    </div>

    <?php 
        if(isAuth('customer'))
        {
            echo "
                <div class='col-lg-3 mb-3'>
                    <div class='item'>
                        <div class='card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <i class='fa-solid m-auto fa-user-group'></i>
                            <h6 class='my-3'>Total Bought Books</h6>
                            <p class='text-success mb-0 fw-bolder'>{$total['boughtBooks']}</p>
                        </div>
                    </div>
                </div>
            ";
        }
    ?>
    
    <?php 
        if(isAuth('admin'))
        {
            echo "
                <div class='col-lg-3 mb-3'>
                    <div class='item'>
                        <div class='card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <i class='fa-solid m-auto fa-user-group'></i>
                            <h6 class='my-3'>Total Authors</h6>
                            <p class='text-success mb-0 fw-bolder'>{$total['authors']}</p>
                        </div>
                    </div>
                </div>
                <div class='col-lg-3 mb-3'>
                    <div class='item'>
                        <div class='card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <i class='fa-solid m-auto fa-users'></i>
                            <h6 class='my-3'>Total Customers</h6>
                            <p class='text-success mb-0 fw-bolder'>{$total['customers']}</p>
                        </div>
                    </div>
                </div>
                <div class='col-lg-3 mb-3'>
                    <div class='item'>
                        <div class='card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <i class='fa-solid m-auto fa-users-gear'></i>
                            <h6 class='my-3'>Total Admins</h6>
                            <p class='text-success mb-0 fw-bolder'>{$total['admins']}</p>
                        </div>
                    </div>
                </div>
            ";
        }
    ?>

    <div class="col-lg-3 mb-3">
        <div class="item">
            <div class="card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis">
                <i class="fa-solid m-auto fa-circle-pause"></i>
                <h6 class="my-3">Total Ordered Orders</h6>
                <p class="text-success mb-0 fw-bolder"><?= $total['orders']['ordered'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class="item">
            <div class="card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis">
                <i class="fa-solid m-auto fa-ban"></i>
                <h6 class="my-3">Total canceled orders</h6>
                <p class="text-success mb-0 fw-bolder"><?= $total['orders']['canceled'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class="item">
            <div class="card text-center px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis">
                <i class="fa-solid m-auto fa-circle-check"></i>
                <h6 class="my-3">Total done orders</h6>
                <p class="text-success mb-0 fw-bolder"><?= $total['orders']['done'] ?></p>
            </div>
        </div>
    </div>
</div>