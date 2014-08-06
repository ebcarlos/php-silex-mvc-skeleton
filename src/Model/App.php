<?php

namespace Model;

use Silex\Application;

class App
{
    /**
     * @var \Silex\Application
     */
    protected $app;

    /**
     * @var App
     */
    protected static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param Application $app
     * @return $this
     */
    public function setup(Application $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return Application
     */
    public function getApp()
    {
        return $this->app;
    }
} 