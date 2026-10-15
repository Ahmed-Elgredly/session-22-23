<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/author/AuthorModel.php";

class AuthorController extends Controller
{
    public function addAuthor()
    {
        $errors = Request::validate([
            "name" => ['required'],
            "bio" => ['required'],
        ]); 

        if (!empty($errors)) {
            return Response::json($errors, "unprocessable_entity", 422);
        }

        $newAuthor = AuthorModel::addAuthor();
        

        return Response::json($newAuthor, "New author added successfully");
    }
}