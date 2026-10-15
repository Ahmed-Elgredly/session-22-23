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
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($orders['done']['data'])) {

                foreach ($orders['done']['data'] as $order) {


                    echo "
                        <tr>
                            <td>{$order['id']}</td>
                            <td>{$order['customer_name']}</td>
                            <td>{$order['total_price']}</td>
                            <td><a href='#' onclick='getItemsIntoCart({$order['order_id']},`show`)'>show</a></td>
                            <td>{$order['created_at']}</td>
                        </tr>  
                    ";
                    }
            } else {
                echo "<p class='alert alert-warning w-75 m-auto text-center'>There are no done orders</p>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
preparePagination($orders['done'], 'orders_done');
?>