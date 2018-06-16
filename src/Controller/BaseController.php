<?php
namespace Controller;
class BaseController
{
    private $config;

    /**
     * BaseController constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }
    public function redirect ($route)
    {
        $url = $this->config['base_url'] . 'index.php?route=' . $route;
    }
    public function render ($template)
    {
        require ($template);
    }
}