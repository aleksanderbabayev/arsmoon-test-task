<?php

require_once 'application/services/Service.php';

class CsvLoaderService extends Service
{
    public function load($_filename, $_delimiter = ',')
    {
        $data = [];
        $file = @fopen($_filename, 'r');
        if ($file === false) throw new Exception('Failed to open \''.$_filename.'\' file.');
        while (($line = fgetcsv($file, 0, $_delimiter)) !== false) $data[] = $line;
        fclose($file);
        return $data;
    }
}
