<?php

class ClassLoader
{
    protected static $services = [];

    public static function getApplication($_server, $_request, $_files)
    {
        require_once 'application/Application.php';
        return new Application($_server, $_request, $_files);
    }

    public static function getAction($_actionName)
    {
        $actionClassName = $_actionName.'action';
        $actionClassFilepath = 'application/actions/'.$actionClassName.'.php';
        if (!file_exists($actionClassFilepath)) throw new Exception('Action class file not found.');
        require_once $actionClassFilepath;
        return new $actionClassName();
    }

    public static function getService($_serviceName)
    {
        if (array_key_exists($_serviceName, self::$services))
            $service = self::$services[$_serviceName];
        else
        {
            $serviceClassName = $_serviceName.'service';
            $serviceClassFilepath = 'application/services/'.$serviceClassName.'.php';
            if (!file_exists($serviceClassFilepath)) throw new Exception('Service class file not found.');
            require_once $serviceClassFilepath;
            $service = new $serviceClassName();
            self::$services[$_serviceName] = $service;
        }
        return $service;
    }
}
