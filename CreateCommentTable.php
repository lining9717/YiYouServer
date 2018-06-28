<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/28
 * Time: 15:15
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$comment_table_sql = "create table comment(
cId int(11) unsigned auto_increment primary key,
cContent varchar(100) not null ,
cUserId int(11) not null,
cUserNickName varchar not null 
)";

if ($conn->query($comment_table_sql) === TRUE) {
    echo "comment table created successfully";
} else {
    echo "Fail to create comment table " . $conn->error;
}

$conn->close();