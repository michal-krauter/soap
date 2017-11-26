<?php

// nastavení PHP pro web službu SOAP
ini_set('default_socket_timeout', 15);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

libxml_disable_entity_loader(false);

// návratové proměnné
$errors = array();
$return_data   = array();
   
if (empty($_POST['name'])){
    $errors['name'] = 'Jméno je nutné vyplnit.';
}
 
if (empty($_POST['password'])){
    $errors['password'] = 'Heslo je nutné vyplnit.';
}    
 
if (empty($_POST['email'])){
    $errors['email'] = 'E-mail je nutné vyplnit.';
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'E-mail není validní.';
}

if (empty($errors)){
    try {		
        $client = new SoapClient("http://oxy-krauter.9e.cz/krauter.wsdl", ['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
        $response = $client->InsertUser($_POST["name"], $_POST["email"], $_POST["password"], $_POST["authority"]);
    }
    catch(Exception $e){
        die($e->getMessage());
    }
	 
    if ($response){
        $return_data['success'] = true;
        $return_data['message'] = 'Uživatel úspěšně registrován.';
    }
    else {                                           
        $return_data['success'] = false;
        $return_data['errors']  = $errors;
        $return_data['message'] = 'Registrace uživatele nebyla úspěšná !';
    }
}
else {                                         
    $return_data['success'] = false;
    $return_data['errors']  = $errors;
    $return_data['message'] = 'Registrace uživatele nebyla úspěšná !';
}
 
echo json_encode($return_data);
 
?>