<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class CartModel extends Model
{
    private static function getPendingOrderId(): false |int
    {
        $DB = Database::getConnection();

        $authId = auth('id');

        $stmt = $DB->query("SELECT id FROM orders WHERE customers_id = {$authId} AND status = 'pending' ");

        return $stmt->fetchColumn();
    }

    private static function getOrderItemId(string $orderId, string $bookId): false |int
    {
        $DB = Database::getConnection();

        $stmt = $DB->query("SELECT id FROM orders_items WHERE order_id = {$orderId} AND book_id = {$bookId} ");

        return $stmt->fetchColumn();
    }

    private static function updataTotalPriceOfOrder(string $orderId)
    {
        $DB = Database::getConnection();

        $totalPrice = $DB->query("SELECT SUM(subtotal) AS total FROM oreders_items WHERE order_id = {$orderId}")->fetchColumn() ?? 0;

        $DB->exec("UPDATE orders SET total_price = {$totalPrice} WHERE order_id = {$orderId}");

        return $totalPrice;
    }

    public static function totalItemsIntoOrders()
    {
        $DB = Database::getConnection();

        $orderId = self::getPendingOrderId();

        if ($orderId == false) {
            return 0;
        }

        $totalItems = $DB->query("SELECT COUNT(*) AS total FROM oreders_items WHERE order_id = {$orderId}")->fetchColumn();

        return $totalItems ?? 0;
    }

    public static function addToCart()
    {
        $DB = Database::getConnection();
        $pendingOrderId = self::getPendingOrderId();
        $authId = auth('id');

        if ($pendingOrderId == false) {
            $DB->exec("INSERT INTO orders (customers_id) VALUES ('{$authId}')");
            $pendingOrderId = $DB->lastInsertId();
        }

        $bookId = Request::input('bookId');

        $quantity = Request::input('quantity');

        $orderItemId = self::getOrderItemId($pendingOrderId, $bookId);

        $unitPrice = $DB->query("SELECT price FROM books WHERE id = '{$bookId}' ")->fetchColumn();

        if ($orderItemId == false) {

            $stmt =  $DB->prepare("INSERT INTO orders_items
                        (order_id, book_id, quantity, unitprice ,subtotal)
                        VALUES
                        (:order_id, :book_id, :quantity, :unitprice , :subtotal)
                        ");

            $stmt->execute([
                "order_id" => $pendingOrderId,
                "book_id" => $bookId,
                "quantity" => $quantity,
                "unitprice" => $unitPrice,
                "subtotal" => (int)$quantity * (float)$unitPrice,
            ]);
        } else {

            $newsubtotal = (int)$quantity * (float)$unitPrice;

            $stmt =  $DB->exec("UPDATE orders_items
                                SET
                                quantity = quantity + {$quantity},
                                subtotal = subtotal + {$newsubtotal}
                                WHERE id = $orderItemId
                                ");
        }

        self::updataTotalPriceOfOrder($pendingOrderId);
    }

    public static function getItemsIntoCart(?int $orderId = null)
    {
        $DB = Database::getConnection();

        if($orderId == null){
            $orderId = self::getPendingOrderId();
        }

        $stmt = $DB->prepare("SELECT
                        books.id AS books_id,
                        books.title,
                        books.image,
                        books.description,
                        books.price,
                        authors.id AS authors_id,
                        authors.name AS authors_name,
                        orders.id AS orders_id,
                        orders_items.quantity,
                        orders_items.subtotal,
                        orders.total_price,
                        FROM orders_items
                        LEFT JOIN orders ON orders.id = orders_items.order_id  
                        LEFT JOIN books ON books.id = orders_items.book_id
                        LEFT JOIN author ON author.id = books.author_id
                        WHERE 
                            orders.id = :order_id
                    ;");

        $stmt->execute([
            'order_id' => $orderId,
        ]);

        return $stmt->fetchAll();
    }

    public static function increaseOrderItem()
    {
        $DB = Database::getConnection();

        $stmt = $DB->prepare("UPDATE orders_items
                                SET
                                    quantity = quantity + 1, 
                                    subtotal = subtotal + unit_price
                                WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        $stmt = $DB->prepare("SELECT * FROM orders_items WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        $orderItem = $stmt->fetch();

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updataTotalPriceOfOrder($orderId);

        return [
            "orderItem" => $orderItem,
            "orderId" => $orderId,
            "totalPrice" => $totalPrice,
        ];
    }

    public static function decreaseOrderItem()
    {
        $DB = Database::getConnection();

        $stmt = $DB->prepare("UPDATE orders_items
                                SET
                                    quantity = quantity - 1, 
                                    subtotal = subtotal - unit_price
                                WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        $stmt = $DB->prepare("SELECT * FROM orders_items WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        $orderItem = $stmt->fetch();

        if($orderItem['quantity'] == 0){
            $stmt = $DB->prepare("DELETE FROM orders_items WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        }

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updataTotalPriceOfOrder($orderId);

        return [
            "orderItem" => $orderItem,
            "orderId" => $orderId,
            "totalPrice" => $totalPrice,
        ];
    }

    public static function deleteOrderItem()
    {
        $DB = Database::getConnection();

        $stmt = $DB->prepare("SELECT * FROM orders_items WHERE id  = :orderItemId ");

        $stmt->execute([
            'orderItemId' => Request::input('orderItemId'),
        ]);

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updataTotalPriceOfOrder($orderId);

        return [
            "totalPrice" => $totalPrice,
        ];
    }

    public static function fireOrder()
    {
        $DB = Database::getConnection();

        $stmt = $DB->prepare("UPDATE FROM orders_items SET status = 'ordered' WHERE id  = :orderId ");

        $stmt->execute([
            'orderId' => Request::input('orderId'),
        ]);

    }
}
