<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 15:06
 */

require_once('Connect.php');

$orderId = $_POST['orderId'];
$star = $_POST['star'];

$sql_user_finish_order = "update `order` set
                          oStatus = 'finished',
                          oToGuideStar = $star
                          where oId = $orderId";
