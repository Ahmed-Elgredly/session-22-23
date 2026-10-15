<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";

class RegisterController extends Controller
{
    public function index()
    {
        $this->view("auth/register");
    }

    public function register()
    {
        $errors = Request::validate([
            'role' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', ],
            'password' => ['required', ['min', 8]],
            'phone' => ['required', 'egPhone', ['unique', 'users']],
            'gender' => ['required'],
        ]);

        if (!empty($errors)) {
            back();
        }

        if (Request::input('role') == 'admin' && !isAuthAdmin('admin')) {
            back('invalid' , "You must to login as admin");
        }

        userModel::createUser();

        $newRole = Request::input('role');

        // session_unset();

        back('successfully', "New {$newRole} created successfully" );
    }
}
