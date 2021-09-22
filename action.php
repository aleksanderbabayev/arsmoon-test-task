<?php

require_once 'bootstrap/ClassLoader.php';

try
{
    ClassLoader::getApplication($_SERVER, $_REQUEST, $_FILES)->run();
}

catch (Exception $e)
{
    header('HTTP/1.1 500 Internal Server Error');
    echo 'ERROR: '.$e->getMessage();
}
