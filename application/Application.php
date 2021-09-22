<?php

class Application
{
    private $server;
    private $request;
    private $files;

    public function __construct($_server, $_request, $_files)
    {
        $this->server = $_server;
        $this->request = $_request;
        $this->files = $_files;
    }

    public function run()
    {
        if ($this->server['REQUEST_METHOD'] != 'POST') throw new Exception('Invalid request method.');
        if (!array_key_exists('action', $this->request)) throw new Exception('Missing \'action\' parameter.');
        ClassLoader::getAction($this->request['action'])->execute($this->request, $this->files);
    }
}
