<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata'); 
$host='localhost';
$user='root';
$password='';
$db='expense_manager';
$conn= mysqli_connect($host,$user,$password,$db);
