<?php 
require_once 'Medoo.php';

use Medoo\Medoo;
 
$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'softengi_cuda',
    'server' => '127.0.0.1',
    'username' => 'root',
    'password' => ''
]);
?>