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

$collect_essay_sql = "create table collectedessay(
ceId int(11) unsigned auto_increment primary key,
ceBowenId int(11) not null,
ceUserId int(11) not null,
ceBowenTitle varchar(50) not null 
)";

if ($conn->query($collect_essay_sql) === TRUE) {
    echo "collect guide table created successfully";
} else {
    echo "Fail to create collect guide table " . $conn->error;
}

$conn->close();