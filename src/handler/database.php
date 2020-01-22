<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Fatal error: Uncaught Exception: Can't connect to the database! mysqli_sql_exception: Access denied for user 'root1'@'localhost' to database 'testx';
try {
    $connection2 = mysqli_connect('localhost', 'root1', '12345', 'loggingdb');
} catch (mysqli_sql_exception $ex) {
    throw new Exception("Can't connect to the database! \n" . $ex);
}

//Custom error handler 
function errorHandler($errno, $errstr, $errfile, $errline) {
    static $db;
    if (empty($db)) {
        $db = new PDO(DSN, DBUSER, DBPASS);
    }

    $query = "INSERT INTO errorlog (severity, message, filename, lineno, time) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $db->prepare($query);

    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
        case E_STRICT:
            $stmt->execute(array("NOTICE", $errstr, $errfile, $errline));
            break;

        case E_WARNING:
        case E_USER_WARNING:
            $stmt->execute(array("WARNING", $errstr, $errfile, $errline));
            break;

        case E_ERROR:
        case E_USER_ERROR:
            $stmt->execute(array("FATAL", $errstr, $errfile, $errline));
            exit("FATAL error $errstr at $errfile:$errline");

        default:
            exit("Unknown error at $errfile:$errline");
    }
}

set_error_handler("errorHandler");