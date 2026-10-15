<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "/../../../models/books/BookModel.php";
require_once __DIR__ . "/../../../models/orders/OrderModel.php";

class ProfileController extends Controller
{
    public function index()
    {
        $data = null;
        if (isAuth('admin')) {
            $data = $this->getAdminData();
        } elseif (isAuth('customer')) {
            $data = $this->getCustomerData();
        }

        // pr($data, true);

        $this->view("/profile/Profile", $data);
    }

    private function getAdminData(): array
    {
        $total = [
            'books' => DBModel::getTotalOfTable('books'),
            'authors' => DBModel::getTotalOfTable('authors'),
            'customers' => DBModel::getTotalOfTable('users', [['role', '=', 'customer']]),
            'admins' => DBModel::getTotalOfTable('users', [['role', '=', 'admin']]),
            'orders' => [
                'ordered' => DBModel::getTotalOfTable('orders', [['status', '=', 'ordered']]),
                'canceled' => DBModel::getTotalOfTable('orders', [['status', '=', 'canceled']]),
                'done' => DBModel::getTotalOfTable('orders', [['status', '=', 'done']]),
            ]
        ];

        $admins = DBModel::getDataOfTable('users', [
            ['role', '=', 'admin'],
            ['id', '!=', auth('id')]
        ], Request::input('admins-page', 1));
        $customers = DBModel::getDataOfTable('users', [['role', '=', 'customer']], Request::input('customers-page', 1));
        $authors = DBModel::getDataOfTable('authors', page: Request::input('authors-page', 1));
        $books = BookModel::getDataOfBooks(page: Request::input('books-page', 1));
        $orders = [
            'ordered' => OrderModel::getDataOfOrders([['status', '=', 'ordered']], Request::input('orders_ordered-page', 1)),
            'canceled' => OrderModel::getDataOfOrders([['status', '=', 'canceled']], Request::input('orders_canceled-page', 1)),
            'done' => OrderModel::getDataOfOrders([['status', '=', 'done']], Request::input('orders_done-page', 1)),
        ];


        return [
            'total' => $total,
            'admins' => $admins,
            'customers' => $customers,
            'authors' => $authors,
            'books' => $books,
            'orders' => $orders
        ];
    }

    private function getCustomerData(): array
    {
        $total = [
            'books' => DBModel::getTotalOfTable('books'),
            'boughtBooks' => DBModel::getTotalBoughtBooksOfCustomer(),
            'totalItemsInCart' => CartModel::totalItemsIntoOrders(),
            'orders' => [
                'ordered' => DBModel::getTotalOfTable('orders', [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'ordered'],

                ]),
                'canceled' => DBModel::getTotalOfTable('orders', [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'canceled'],

                ]),
                'done' => DBModel::getTotalOfTable('orders', [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'done'],

                ]),
            ]
        ];

        $books = BookModel::getDataOfBooks(page: Request::input('books-page', 1));
        $orders = [
            'ordered' => OrderModel::getDataOfOrders(
                [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'ordered']
                ],
                Request::input('orders_ordered-page', 1)
            ),
            'canceled' => OrderModel::getDataOfOrders(
                [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'canceled']
                ],
                Request::input('orders_canceled-page', 1)
            ),
            'done' => OrderModel::getDataOfOrders(
                [
                    ['customer_id', '=', auth('id')],
                    ['status', '=', 'done']
                ],
                Request::input('orders_done-page', 1)
            ),
        ];

        return [
            'total' => $total,
            'books' => $books,
            'orders' => $orders
        ];
    }
}
