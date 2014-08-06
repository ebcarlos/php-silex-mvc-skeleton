<?php

namespace Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class Index extends BaseController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        /**
         * @var ControllerCollection $controller
         */
        $controller = $app['controllers_factory'];

        $controller->get('/', 'Controller\Index::index');

        return $controller;
    }

    public function index()
    {
        return $this->twig->render('home.twig');
    }
}