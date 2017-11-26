<?php 

 /**
  *  Select all registered users
  *
  * @param string $myArgument With a *description* of this argument, these may also
  *    span multiple lines.
  *
  * @return array
  */
function SelectAll(){
    $db = new Db();
    $rows = $db -> select("SELECT * FROM `users` "); 
    return $rows;
}

 /**
  *  Insert user into db
  *
  * @param string $name
  * @param string $email
  * @param string $passwd
  * @param string $authority
  *
  * @return boolen
  */
function InsertUser($name, $email, $passwd, $authority = 'user'){
    $db = new Db();
    $result = $db -> query("INSERT INTO `users` (`name`, `email`, `password`, `authority`) VALUES (".$db -> quote($name).", ".$db -> quote($email).", ".$db -> quote($passwd).", ".$db -> quote($authority)."); "); 
    if($result === false) {
        return false;
    }
    else return true;
}

require_once 'config.inc.php';
require_once 'db.class.php';

ini_set("soap.wsdl_cache_enabled", "0");

$server = new SoapServer("krauter.wsdl");
$server->addFunction("InsertUser"); 
$server->addFunction("SelectAll");
$server->handle(); 

?>