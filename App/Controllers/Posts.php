<?php
namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\Post;

class Posts extends Controller
{
    public function indexAction()
    {
        $post=Post::getAll();
        View::render('Posts/index.php',[
            'posts'=>$post
        ]);
    }
    public function addNewAction()
    {
        echo 'Hello from posts controller and add new action';
    }
    public function editAction()
    {
        echo 'Hello from the edit action in the Post controller!';
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}