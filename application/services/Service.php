<?php

abstract class Service
{
    public $config = [];
    
    public function __construct()
    {
        $configFilepath = 'config/'.get_class($this).'.php';
        if (file_exists($configFilepath)) $this->config = require $configFilepath;
    }
}
