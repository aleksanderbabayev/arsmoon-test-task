<?php

require_once 'application/services/Service.php';

class CurlService extends Service
{
    public function get($_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        
        if ($result === false) throw new Exception('Failed to get data from \''.parse_url($_url, PHP_URL_HOST).'\'.');
        return $result;
    }
}
