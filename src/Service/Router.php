<?php
namespace Service;
class Router
{
    private $routes;

    /**
     * Router constructor.
     * @param $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    public function resolve(array $params)
    {
        $parts = [];
        parse_str($_SERVER['QUERY_STRING'],$parts);
        foreach($this->routes as $route => $controllerData){
            if ($parts['route'] === $route) {
                return $controllerData;
            }
        }
        return ['home' => 'home'];
    }
}