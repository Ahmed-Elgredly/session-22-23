<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/admin/AdminModel.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";

class AdminController extends Controller
{
    public function banUser(){
        
        Response::json(Request::all());

        $errors = Request::validate([
            'userId' => ['required', ['exists', 'user', 'id']]
        ]);

        if(!empty($errors)){
            Response::json($errors, status: 422);
        }

        $idOfBanUser = Request::input('userID');

        $roleOfBanUser = DBModel::getRoleOfUser($idOfBanUser); 

        if($roleOfBanUser == 'admin' && auth('id') > $idOfBanUser){
            Response::json([], "NO", 403);
        }

        $user = AdminModel::banUser();

        Response::json($user);

    }
}