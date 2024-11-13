<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

// untuk membuat koneksi antara database dan web ke dalam sistem  
$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
    echo "koneksi database rusak";
    die("error!");
}

?>