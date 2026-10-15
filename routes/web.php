<?php

require_once __DIR__ . "/../core/Route.php";
require_once __DIR__ . "/../app/controller/web/HomeController.php";
require_once __DIR__ . "/../app/controller/web/auth/LoginController.php";
require_once __DIR__ . "/../app/controller/web/auth/RegisterController.php";
require_once __DIR__ . "/../app/controller/web/profile/ProfileController.php";
require_once __DIR__ . "/../app/controller/web/user/UserController.php";
require_once __DIR__ . "/../app/controller/web/author/AuthorController.php";
require_once __DIR__ . "/../app/controller/web/book/BookController.php";
require_once __DIR__ . "/../app/controller/web/admin/AdminController.php";
require_once __DIR__ . "/../app/controller/web/cart/CartController.php";
require_once __DIR__ . "/../app/middlewares/AuthMiddleware.php";
require_once __DIR__ . "/../app/middlewares/GuestMiddleware.php";
require_once __DIR__ . "/../app/middlewares/RegisterMiddleware.php";


Route::get("", HomeController::class, "index");

Route::get("/auth/login", LoginController::class, "index", [GuestMiddleware::class]);
Route::post("/auth/login", LoginController::class, "login");

Route::get("/auth/logout", LoginController::class, "logout", [AuthMiddleware::class]);

Route::get("/auth/register", RegisterController::class, "index", [RegisterMiddleware::class]);
Route::post("/auth/register", RegisterController::class, "register");

/* =========== User =========== */

Route::get("/profile", ProfileController::class, "index", [AuthMiddleware::class]);
Route::post("/profile/editName", UserController::class, "editName", [AuthMiddleware::class]);
Route::post("/profile/editEmail", UserController::class, "editEmail", [AuthMiddleware::class]);
Route::post("/profile/editGender", UserController::class, "editGender", [AuthMiddleware::class]);
Route::post("/profile/editPhone", UserController::class, "editPhone", [AuthMiddleware::class]);
Route::post("/profile/editPassword", UserController::class, "editPassword", [AuthMiddleware::class]);
Route::post("/profile/filterBooks", BookController::class, "filterBooks", [AuthMiddleware::class]);

/* =========== Admin =========== */

Route::post("/profile/addAuthor", AuthorController::class, "addAuthor", ["AuthMiddleware:admin"]);
Route::post("/profile/addBook", BookController::class, "addBook", ["AuthMiddleware:admin"]);
Route::post("/profile/banUser", BookController::class, "banUser", ["AuthMiddleware:admin"]);

/* =========== customer =========== */
Route::post("/profile/addToCart", CartController::class, "addToCart", ["AuthMiddleware:customer"]);
Route::post("/profile/getItemsIntoCart", CartController::class, "getItemsIntoCart", ["AuthMiddleware:customer"]);
Route::post("/profile/increaseOrderItem", CartController::class, "increaseOrderItem", ["AuthMiddleware:customer"]);
Route::post("/profile/decreaseOrderItem", CartController::class, "decreaseOrderItem", ["AuthMiddleware:customer"]);
Route::post("/profile/deleteOrderItem", CartController::class, "deleteOrderItem", ["AuthMiddleware:customer"]);
Route::post("/profile/fireOrder", CartController::class, "fireOrder", ["AuthMiddleware:customer"]);