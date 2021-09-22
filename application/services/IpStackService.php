<?php

require_once 'application/services/Service.php';

class IpStackService extends Service
{
    protected $cache = [];

    public function getContinentCode($_ip)
    {
        if (array_key_exists($_ip, $this->cache))
            $continentCode = $this->cache[$_ip];
        
        else {
            $url = 'http://'.$this->config['domain'].'/'.$_ip.'?access_key='.$this->config['token'].'&fields=continent_code';
            $result = ClassLoader::getService('curl')->get($url);
            $result = json_decode($result, true);
            
            if (array_key_exists('success', $result) and $result['success'] === false)
                throw new Exception('Failed to get continent code from ipstack. '.$result['error']['info']);

            $continentCode = $result['continent_code'];
            $this->cache[$_ip] = $continentCode;
        }
        
        return $continentCode;
    }
}
