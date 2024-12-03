<!-- koneksi database -->

<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "formulir";

$db= new mysqli($hostname, $username, $password, $database_name);

if($db->connect_error){
    echo 'terdapat kesalahan koneksi';
    die("error");
}
?>