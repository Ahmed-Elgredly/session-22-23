<?php

/**
 * @var array $customers
 */

?>

<div class="row">

    <?php
    if (!empty($customers['data'])) {

        foreach ($customers['data'] as $customer) {

            $customerImg = asset('/images/customer.png');
            $isBageBaned = ($customer['is_banned'] == 1) ? "<span class='badge text-bg-danger position-absolute' style='top: 10px; right: 10px;'>Baned</span>" : '';
            $isButtonBaned = ($customer['is_banned'] == 1) ? "<button class='btn btn-danger w-100' onclick='banUser({$customer['id']}, `Unban`)'>UNBAN</button>" 
                                                            : 
                                                             "<button class='btn btn-danger w-100' onclick='banUser({$customer['id']}, `Ban`)'>BAN</button>";


            echo "
                    <div class='col-lg-4 mb-3'>
                        <div class='item'>
                            <div class='card px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis' data-user-id = '{$customer['id']}'>
                                {$isBageBaned} 
                                <img src='{$customerImg}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title mb-4 text-center'> {$customer['name']}</h5>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Email :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$customer['email']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Gender :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$customer['gender']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Phone :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>{$customer['phone']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    {$isButtonBaned}
                                </div>
                            </div>
                        </div>
                    </div>
                ";
        }
    } else {
        echo "<p class='alert alert-warning w-75 m-auto text-center'>There are no customers</p>";
    }
    ?>

</div>

<?php
preparePagination($customers, 'customers');
?>