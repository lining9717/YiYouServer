<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/2
 * Time: 14:26
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$sql_get_order_guides = "create table getorderguides(
gogId int(11) unsigned auto_increment primary key,
gogOrderId int(11) not null,
gogGuideId int(11) not null,
gogGuideName varchar(50) not null
)";

if ($conn->query($sql_get_order_guides) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Fail to create table " . $conn->error;
}
$conn->close();