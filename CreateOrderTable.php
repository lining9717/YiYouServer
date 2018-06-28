<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/28
 * Time: 15:18
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$order_table_sql = "create table order(
oId int(11) unsigned auto_increment primary key,
oStatus varchar(10) not null,
oUserId int(11) not null,
oGuideId int(11),
oPlace varchar(100) not null ,
oData date not null ,
oNumberOfPeople int not null ,
oDescription varchar(100) not null ,
oToUserStar int,
oToGuideStar int
)";

if ($conn->query($order_table_sql) === TRUE) {
    echo "order table created successfully";
} else {
    echo "Fail to create order table " . $conn->error;
}

$conn->close();