<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/29
 * Time: 14:50
 */

$servername = "localhost";
$username = "root";
$password = "abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$bowen_image_table_sql = "create table bowenImg(
biId int(11) unsigned auto_increment primary key,
biBowenId int(11) not null,
biImage varchar(100) not null
)";

if ($conn->query($bowen_image_table_sql) === TRUE) {
    echo "bowen image table created successfully";
} else {
    echo "Fail to create bowen image table " . $conn->error;
}

$conn->close();