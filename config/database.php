<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Setting up the time zone
date_default_timezone_set('America/Mexico_City');
// Host Name se cambia por: MySQL Hostname de InfinityFree: sql308.infinityfree.com
$db_hostname = 'sql308.infinityfree.com';  
// Database Name En InfinitiyFree: List of MySQL Databases\Database Name -> if0_40996511_db_vmh
$db_name = 'if0_40996511_db_vmh';
// Database En InfinitiyFree: MySQL Connection Details\MySQL Username -> if0_40996511
$db_username = 'if0_40996511';
// Database Password En InfinitiyFree: MySQL Connection Details\MySQL Password -> ******
$db_password = 'bUgSyZgHyg';

try {
    $conn = new PDO("mysql:host=$db_hostname; dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>