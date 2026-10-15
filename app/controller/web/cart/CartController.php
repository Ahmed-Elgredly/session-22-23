<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/cart/CartModel.php";

class CartController extends Controller
{
    public function addToCart()
    {
        $errors = Request::validate([
            'bookId' => ['required', ['exists', 'books', 'id']],
            'quantity' => ['required'],
        ]);

        if (!empty($errors)) {
            Response::error("error", 403);
        }

        CartModel::addToCart();

        $totalItems = CartModel::totalItemsIntoOrders();

        Response::json([
            'totalItems' => $totalItems
        ]);
    }

    public function getItemsIntoCart()
    {
        if (Request::input('orderId') != null) {
            $errors =  Request::validate([
                'orderId' => ['required', ['exists', 'orders', 'id']],
            ]);

            if (!empty($errors)) {
                Response::error("error", 403);
            }
        }

        $data = CartModel::getItemsIntoCart(Request::input('orderId'));

        Response::json($data);
    }

    public function increaseOrderItem()
    {
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json($errors, status: 422);
        }

        $data = CartModel::increaseOrderItem();

        Response::json($data);
    }

    public function decreaseOrderItem()
    {
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json($errors, status: 422);
        }

        $data = CartModel::decreaseOrderItem();

        Response::json($data);
    }

    public function deleteOrderItem()
    {
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json($errors, status: 422);
        }

        $data = CartModel::deleteOrderItem();

        Response::json($data);
    }

    public function fireOrder()
    {
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json($errors, status: 422);
        }

        CartModel::fireOrder();
    }
}
