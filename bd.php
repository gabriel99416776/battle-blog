<?php
$conn = new mysqli("localhost","root","","battlefield");

if ($conn->connect_error){
    echo "Error". $conn->connect_error;
    exit;
}

?>