<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\User;

class AuthController
{

    public function subscribe(string $login, string $email, string $pass)
    {

        $user = new User();
        $user->addUser($login, $email, $pass);

        // redirect to index when done
        header("location: ./");

    }

    public function showSubscriptionForm()
    {

        include __DIR__ . '/../views/includes/header.view.php';
        include __DIR__ . '/../views/subscription.view.php';
        include __DIR__ . '/../views/includes/footer.view.php';

    }

    public function login()
    {

    }

    public function showLoginForm()
    {

    }

    public function logout()
    {

    }

}