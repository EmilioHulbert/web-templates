<?php 

try {
    $db=new PDO("mysql:host=localhost;dbname=ecommmerce;charset=utf8",'admin','melody254');
    //echo "Connection Successful";

} catch (PDOException $e) {
    echo $e -> getMessage();
}
?>
