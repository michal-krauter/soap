<?php  

    ini_set('default_socket_timeout', 15);
    ini_set('soap.wsdl_cache_enabled',0);
    ini_set('soap.wsdl_cache_ttl',0);
    libxml_disable_entity_loader(false);

    try {	
        $client = new SoapClient("http://oxy-krauter.9e.cz/krauter.wsdl", ['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
        $results = $client->SelectAll();
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
 
    if (is_array($results)){
 ?>
        <html>
        <head>
            <meta charset="utf-8">
            <title>User system - SOAP - Michal Krauter</title>
            <link rel="stylesheet" type="text/css" href="client.css" />
        </head>

        <body>
            <h1>User system - SOAP</h1>
            <h2>Michal Krauter</h2>
            <h3>[ Výpis registrovaných uživatelů ]</h3>
            <table class="list">
                <tr><th>Jméno</th><th>Heslo</th><th>E-mail</th><th>Typ účtu</th></tr>
<?php
                foreach ($results as $key => $val){
                    echo '<tr><td>'.$val["name"].'</td><td>'.$val["password"].'</td><td>'.$val["email"].'</td><td>'.$val["authority"].'</td></tr>';
                }
?>
            </table>
            <a href="http://oxy-krauter.8u.cz/index.php">Vložit uživatele</a>
        </body>
        </html>
<?php
    }
?>