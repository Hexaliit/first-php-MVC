<?php
namespace App\Controllers\Admin;

use Core\Controller;

class Users extends Controller
{
    protected function before()
    {

    }
    public function indexAction()
    {
        echo 'index from users and admin';
    }
}