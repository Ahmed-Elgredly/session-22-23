<?php

require_once __DIR__ . "/Middlewares.php";

class RegisterMiddleware implements Middlewares
{
    public function handle(string ...$role): void
    {



        if(isAuth('customer')){
        // Response::error("Already Authenticated", 403);
        redirect('/profile');
        }
    }
}