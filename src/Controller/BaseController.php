<?php

namespace Controller;

use Model\App;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseController
{
    /**
     * @var \Silex\Application
     */
    protected $app;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        $appInstance = App::getInstance();
        $app = $appInstance->getApp();
        $this->app = $app;

        $this->twig = $app['twig'];
        $this->request = $app['request'];
        $this->db = $app['db'];
        $this->session = $app['session'];
    }

    /**
     * Get config.
     *
     * @param $config
     * @return null | array | string
     */
    public function config($config)
    {
        try {
            return $this->app['config'][$config];
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getRequest($name)
    {
        return $this->request->request->get($name);
    }

    public function getQuery($name)
    {
        return $this->request->query->get($name);
    }

    /**
     * Redirect user without an actual http redirect.
     *
     * @param $uri
     * @param string $method
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function internalRedirect($uri, $method = "GET")
    {
        $subRequest = Request::create($uri, $method);
        return $this->app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }
} 