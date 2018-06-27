<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 13:27
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}


$user_table_sql = "create table user(
uId int(11) unsigned auto_increment primary key,
uNickname varchar(50)  not null,
uTelephone int(11) not null,
uSex varchar(50) not null,
uHeadPhoto varchar(200) not null,
uIntroduce varchar(100) not null,
uIsGuide varchar(11) not null,
uGuideId int(11),
uCollectGuideId int(11),
uCollectEssayId int(11),
uStars int not null
)";

if ($conn->query($user_table_sql) === TRUE) {
    echo "User table created successfully";
} else {
    echo "Fail to create user table " . $conn->error;
}


