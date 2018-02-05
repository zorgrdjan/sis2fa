<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of odjava
 *
 * @author Zoran
 */
include('config.php');
$session_uid='';
$session_googleCode='';
$_SESSION['uid']=''; 
$_SESSION['googleCode']='';
if(empty($session_uid) && empty($_SESSION['uid']))
{
$url=BASE_URL.'index.php';
header("Location: $url");
}
?>