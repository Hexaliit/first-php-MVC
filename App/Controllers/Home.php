<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{
    public function indexAction()
    {
        View::render('Home/index.php');
    }
    public function aboutAction()
    {
        View::render('Home/about.php');
    }
    protected function after()
    {

    }
    protected function before()
    {

    }

}