<?php

require_once 'application/services/Service.php';

class UploadedFileService extends Service
{
    public function handle($_file, $_params = [])
    {
        if ($_file['error'] !== UPLOAD_ERR_OK) throw new Exception('Failed to upload a file.');
        if (array_key_exists('ext', $_params)) {
            if (pathinfo($_file['name'], PATHINFO_EXTENSION) != $_params['ext'])
                throw new Exception('Invalid file type. '.$_params['ext'].'-file is required');
        }
        $fileName = basename($_file['name']);
        $filePath = 'uploads/'.$fileName;
        if (@move_uploaded_file($_file['tmp_name'], $filePath) === false) throw new Exception('Failed to move uploaded file.');
        return $fileName;
    }
}
