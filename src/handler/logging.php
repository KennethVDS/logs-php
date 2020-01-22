<?php
$errLvl = error_reporting();
for ($i = 0; $i < 15;  $i++ ) {
    print FriendlyErrorType($errLvl & pow(2, $i)) . "<br>\\n";
}

function FriendlyErrorType($type)
{
    switch($type)
    {
        case E_ERROR: // 1 //
            return 'E_ERROR';
        case E_WARNING: // 2 //
            return 'E_WARNING';
        case E_PARSE: // 4 //
            return 'E_PARSE';
        case E_NOTICE: // 8 //
            return 'E_NOTICE';
        case E_CORE_ERROR: // 16 //
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: // 32 //
            return 'E_CORE_WARNING';
        case E_COMPILE_ERROR: // 64 //
            return 'E_COMPILE_ERROR';
        case E_COMPILE_WARNING: // 128 //
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: // 256 //
            return 'E_USER_ERROR';
        case E_USER_WARNING: // 512 //
            return 'E_USER_WARNING';
        case E_USER_NOTICE: // 1024 //
            return 'E_USER_NOTICE';
        case E_STRICT: // 2048 //
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: // 4096 //
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: // 8192 //
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: // 16384 //
            return 'E_USER_DEPRECATED';
    }
    return "";
}
$test = 5;
if ($test > 1) {
   trigger_error("Value of $test must be 1 or less", E_USER_NOTICE);
}

function hasAccess($username,$password){
    $form = array();
    $form['username'] = $username;
    $form['password'] = $password;

    $securityDAO = $this->getDAO('SecurityDAO');
    $result = $securityDAO->hasAccess($form);

    //Write action to txt log
    $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
            "Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
            "User: ".$username.PHP_EOL.
            "-------------------------".PHP_EOL;
    //-
    file_put_contents('./log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);

    if($result[0]['success']=='1'){
        $this->Session->add('user_id', $result[0]['id']);
        //$this->Session->add('username', $result[0]['username']);
        //$this->Session->add('roleid', $result[0]['roleid']);
        return $this->status(0,true,'auth.success',$result);
    }else{
        return $this->status(0,false,'auth.failed',$result);
    }
}