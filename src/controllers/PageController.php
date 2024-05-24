<?php

namespace Controllers;

class PageController
{
    public function page_404(): void
    {
        include __DIR__ . '/../views/404.view.php';
    }

    public function page_500($errorMessage)
    {
        $error = $errorMessage;
        include __DIR__ . '/../views/500.view.php';
    }
}