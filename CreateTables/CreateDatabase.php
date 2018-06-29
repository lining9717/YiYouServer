<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 13:09
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$conn = new mysqli($servername,$username,$password);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$sql = "create database YiYou";
if($conn->query($sql) === true){
    echo "Creating database successful";
}else{
    echo "Error creating database ".$conn->error;
}
$conn->close();
