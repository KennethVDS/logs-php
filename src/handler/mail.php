<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $connection2 = mysqli_connect('localhost', 'root', '12345', 'loggingdb');
} catch (mysqli_sql_exception $ex) {
    die("Can't connect to the database! \n" . $ex);
}
// will email the error log
error_log("This is a sample error.", 1, "love.gerald@yahoo.com");