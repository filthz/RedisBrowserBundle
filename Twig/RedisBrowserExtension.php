<?php

namespace Filth\RedisBrowserBundle\Twig;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Filth\RedisBrowserBundle\Controller\RedisBrowserController;
use \Symfony\Component\DependencyInjection\Container;



class RedisBrowserExtension extends \Twig_Extension
{
    private $router;
    private $clients;
    private $templating;


    public function __construct($templating)
    {
        $this->templating = $templating;
    }

    public function getFunctions() {
        return array(
            'getRedisBrowser' => new \Twig_Function_Method($this, 'getRedisBrowser'),
        );
    }

    public function getRedisBrowser($clients)
    {
        $this->clients = $clients;

        $c = new RedisBrowserController();
        return $c->indexAction($clients, $this->templating);
    }

    public function getName()
    {
        return 'filth_redis_browser';
    }

}
