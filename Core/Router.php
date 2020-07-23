<?php
namespace Core;

class Router
{
    protected $Route=[];
    protected $params=[];
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->Route[$route] = $params;
    }
    public function getRoutes()
    {
        return $this->Route;
    }
    public function match($url)
    {
        // Match to the fixed URL format /controller/action
        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach ($this->Route as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }
    public function getParams()
    {
        return $this->params;
    }
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            //$controller = "App\Controllers\\$controller";
            $controller=$this->getNamespace().$controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);


                if (preg_match('/action$/i', $action) == 0) {
                    if (isset($this->params['id'])) {
                        $controller_object->$action($this->params['id']);
                    } else {
                        $controller_object->$action();
                    }
                } else {
                    //echo "Method $action (in controller $controller) not found";
                    throw new \Exception("Method $action (in controller $controller) not found");
                }
            } else {
                //echo "Controller class $controller not found";
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            //echo 'No route matched.';
            throw new \Exception('No route matched.');
        }
    }
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
    /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }
    protected function getNamespace()
    {
        $namespace='App\Controllers\\';
        if (array_key_exists('namespace',$this->params))
        {
            $namespace .=$this->params['namespace'].'\\';
        }
        return $namespace;
    }
}