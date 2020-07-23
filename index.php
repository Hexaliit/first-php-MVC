<?php
$uri=empty($_GET['uri']) ? '/' : $_GET['uri'];
require_once './Vendor/autoload.php';
require_once 'App/Helpers/config.php';
require_once 'App/Helpers/session_helper.php';

set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router=new Core\Router();
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{action}/{id:\d+}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->dispatch($uri);
/*$router->add('/',['Controller'=>'Home','Action'=>'index']);
$router->add('posts',['Controller'=>'Post','Action'=>'index']);
$router->add('posts/new',['Controller'=>'Post','Action'=>'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');*/

// Display the routing table
/*echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';
if ($router->match($uri))
{
echo '<pre>';
var_dump($router->getParams());
echo '</pre>';
}
else
{
    echo '404 page not found....!';
}*/
