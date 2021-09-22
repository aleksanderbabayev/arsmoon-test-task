<?php

require_once 'application/actions/Action.php';

class CallsStatsAction extends Action
{
    public function execute($_request, $_files = null)
    {
        if (!array_key_exists('file', $_files)) throw new Exception('Missing required file parameter.');

        
        $csvLoader = ClassLoader::getService('csvloader');
        $countries = $csvLoader->load('data/countries.csv', "\t");
        $continentByPhoneCode = [];
        foreach ($countries as $country) $continentByPhoneCode[$country[12]] = $country[8];


        $uploadedFilename = ClassLoader::getService('uploadedfile')->handle($_files['file'], ['ext' => 'csv']);
        $calls = $csvLoader->load('uploads/'.$uploadedFilename);
        
        
        $stats = [];
        foreach ($calls as $call)
        {
            list($customerId, $callDate, $duration, $dialedNumber, $customerIp) = $call;
            
            if (!array_key_exists($customerId, $stats))
            {
                $stats[$customerId] = [
                    'num_calls_same_continent' => 0,
                    'total_duration_same_continent' => 0,
                    'total_num_calls' => 0,
                    'total_duration' => 0,
                ];
            }
            

            $phoneCode = substr($dialedNumber, 0, 3);
            if (!array_key_exists($phoneCode, $continentByPhoneCode))
            {
                $phoneCode = substr($dialedNumber, 0, 2);
                if (!array_key_exists($phoneCode, $continentByPhoneCode))
                    $phoneCode = substr($dialedNumber, 0, 1);
            }
            if (!array_key_exists($phoneCode, $continentByPhoneCode))
                throw new Exception('Undefined phone code ('.$dialedNumber.')');
            

            $dialedContinent = $continentByPhoneCode[$phoneCode];
            $customerContinent = ClassLoader::getService('ipstack')->getContinentCode($customerIp);
            if ($dialedContinent == $customerContinent)
            {
                $stats[$customerId]['num_calls_same_continent'] += 1;
                $stats[$customerId]['total_duration_same_continent'] += $duration;
            }
            $stats[$customerId]['total_num_calls'] += 1;
            $stats[$customerId]['total_duration'] += $duration;
        }
        
        
        require 'views/stats.php';
    }
}
