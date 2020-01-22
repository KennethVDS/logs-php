<?php
class FileExistException extends Exception { }
class FileReadException extends Exception { }
//catch nested to different 
$filename = 'D:Exception.txt';
try {
    try {
        $text = file_get_contents($filename);
        if ($text === false) {
            throw new Exception();
        }
    }
    catch (Exception $e) {
        if (!file_exists($filename)) {
            throw new FileExistException($filename . " does not exist.");
        }
        elseif (!is_readable($filename)) {
            throw new FileReadException($filename . " is not readable.");
        }
        else {
            throw new Exception("Unknown error accessing file.");
        }
    }
}
catch (FileExistException $fe) {
    echo $fe->getMessage();
    error_log($fe->getTraceAsString());
}
catch (FileReadException $fr) {
    echo $fr->getMessage();
    error_log($fr->getTraceAsString());
}



