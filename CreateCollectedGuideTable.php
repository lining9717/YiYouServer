<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/29
 * Time: 13:47
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$collect_guide_sql = "create table collectedguide(
cgId int(11) unsigned auto_increment primary key,
cgGuideId int(11) not null,
cgUserId int(11) not null,
cgGuideRealName varchar(50) not null 
)";

if ($conn->query($collect_guide_sql) === TRUE) {
    echo "collect guide table created successfully";
} else {
    echo "Fail to create collect guide table " . $conn->error;
}

$conn->close();