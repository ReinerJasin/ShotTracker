<?php
/**
 * using mysqli_connect for database connection
 */

$dbHost = 'localhost';
$dbName = 'crud_db';
$dbUser = 'root';
$dbPass = '';

$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

?>