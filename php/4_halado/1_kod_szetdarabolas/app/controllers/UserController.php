<?php

namespace App\Controllers;

use App\Models\Paginator;
use App\Models\User;

class UserController{
    public static function index(): void
    {
        $paginator = new Paginator(User::all(), 10, $_GET['page'] ?? 1);
        $users = $paginator->paginate();
        view('index-user', ['users' => $users, 'paginator' => $paginator]);
    }
    public static function view(): void
    {
        $id = $_GET['id'];
        $user = User::find($id);

        if(!$user){
            fail('Felhasználó nem található!', 404);
        }

        view('view-user', ['user' => $user]);
    }

    public static function create(): void
    {
        view('create-user');
    }

    public static function store(): void
    {
        $user = new User();

        $errors = [];

        if(empty($_POST['first-name'])){
            $errors['first-name'] = 'Keresztnév megadása kötelező!';
        }

        if(empty($_POST['last-name'])){
            $errors['last-name'] = 'Vezetéknév megadása kötelező!';
        }

        if(empty($_POST['email'])){
            $errors['email'] = 'E-mail cím megadása kötelező!';
        }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Hibás e-mail cím!';
        }

        if(empty($_POST['gender'])){
            $errors['gender'] = 'Nem megadása kötelező!';
        }
        else if(!in_array($_POST['gender'], ['Male', 'Female'])){
            $errors['gender'] = 'Hibás nem!';
        }

        if(empty($_POST['city'])){
            $errors['city'] = 'Város megadása kötelező!';
        }

        if(empty($_POST['birthday'])){
            $errors['birthday'] = 'Születési dátum megadása kötelező!';
        }

        if(!empty($errors)){
            redirect('/user/new', ["errors" => $errors, "old" => $_POST]);
        }

        $user->first_name = $_POST['first-name'];
        $user->last_name = $_POST['last-name'];
        $user->email = $_POST['email'];
        $user->gender = $_POST['gender'];
        $user->city = $_POST['city'];
        $user->birthday = $_POST['birthday'];

        $id = $user->save();

        redirect('/user?id=' . $id, ["status" => "Felhasználó sikeresen létrehozva!"]);
    }

}