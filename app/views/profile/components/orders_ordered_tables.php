<?php

/**
 * @var array $orders
 */

?>

<div class="table-responsive">
    <table class="table table-striped table-hover table-info">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Price</th>
                <th>Statues</th>
                <th>Created_at</th>
                <?php 
                if(isAuth('admin')){
                    echo "<th>Options</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($orders['ordered']['data'])) {

                foreach ($orders['ordered']['data'] as $order) {

                    $additionalCol = "";

                    if(isAuth('admin')){
                        $additionalCol = "
                            <td>
                                <div class='buttons'>
                                    <button class='btn btn-danger me-2'>Cancel</button>
                                    <button class='btn btn-success'>Done</button>
                                </div>
                            </td>  
                        ";
                    }

                    echo "
                        <tr>
                            <td>{$order['id']}</td>
                            <td>{$order['customer_name']}</td>
                            <td>{$order['total_price']}</td>
                            <td><a href='#' onclick='getItemsIntoCart({$order['order_id']},`show`)'>show</a></td>
                            <td>{$order['created_at']}</td>
                            {$additionalCol}
                        </tr> 
                    ";
                    }
            } else {
                echo "<p class='alert alert-warning w-75 m-auto text-center'>There are no ordered orders</p>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
preparePagination($orders['ordered'], 'orders_ordered');
?>