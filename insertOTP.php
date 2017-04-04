<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include("connect.php");
$email = $_SESSION['emailforotp'];
$otp = $_SESSION['otp'];
header("location:enterOTP.php");
