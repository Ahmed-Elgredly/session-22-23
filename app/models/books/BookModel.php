<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class BookModel extends Model
{
    public static function getDataOfBooks(array $wheres = [], string $sort = "DESC" , int $page = 1): array
    {
        $DB = Database::getConnection();

        $whereQuery = Model::prepareWhereQuery($wheres);
        
        $offset = ($page * 10) - 10;

        $stmt = $DB->query("SELECT books.*, 
                            authors.name AS author_name
                            FROM books
                            LEFT JOIN authors ON authors.id = books.author_id
                            {$whereQuery}
                            ORDER BY books.id {$sort}
                            LIMIT 10 OFFSET {$offset}
                            ;");

        $data = $stmt->fetchAll();

        $stmt = $DB->query("SELECT COUNT(*) AS total 
                            FROM books
                            LEFT JOIN authors ON authors.id = books.author_id
                            {$whereQuery};");

        $total = $stmt->fetch()['total'];

        return [
            'data' => $data,
            'total' => $total,
            'currentPage' => $page,
        ];

    }

    public static function filterBooks()
    {


        $DB = Database::getConnection();

        

    }

    public static function addBook()
    {
        $DB = Database::getConnection();

        $stmt = $DB->prepare("INSERT INTO books
                                (author_id, title, image, description, price, stock)
                            VALUE
                                (:author_id, :title, :image, :description, :price, :stock)
                            ");
                            
        $stmt->execute([
            "author_id" => Request::input('bookAuthorId'),
            "title" =>  Request::input('bookTitle'),
            "image" =>  self::uploadImage('bookImage'),
            "description" =>  Request::input('bookDescription'),
            "price" =>  Request::input('bookPrice'),
            "stock" =>  Request::input('bookStock'),
        ]);

        $newBookId =   $DB->lastInsertId();

        $newBook = self::getDataOfBooks([
            ['books.id', '=', $newBookId],
        ])['data'][0];

        return $newBook;
    }

    public static function uploadImage(string $fileName): ?string
    {
        if(Request::hasFile($fileName)){

            $file = Request::File($fileName);
            $fileName = $file['name'];
            $fileOriginalName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileOriginalExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $fileTemp = $file['tmp_name'];

            $allowExtension = ['png', 'jpg', 'jpeg'];
            if(!in_array($fileOriginalExtension, $allowExtension)){
                Response::error("File Extension not allowed", 403);
            }

            $fileNewName = $fileOriginalName . "_" . time() . "." . $fileOriginalExtension;

            $uploadDir = __DIR__ . "/../../../public/assets/images/uploads";

            if(!is_dir($uploadDir)){
                mkdir($uploadDir);
            }

            $uploadPath = $uploadDir . "/" . $fileNewName;

            if(!move_uploaded_file($fileTemp, $uploadPath)){
                Response::error("Error to upload photo", 403);
            }


            return $fileNewName;

        }else {

            return null;
        
        }
    }
}
