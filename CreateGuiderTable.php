<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 14:12
 */

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Fail to connect: ".$conn->connect_error);
}

$guider_table_sql = "create table guide(
gId int(11) unsigned auto_increment primary key,
gRealName varchar(50) not null,
gIDNumber varchar(50) not null,
gGuideNumber varchar(50) not null,
gServerCity varchar(50) not null,
gStars int not null
)";

$conn->close();