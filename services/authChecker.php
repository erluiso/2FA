<?php
    if(!isset($_SESSION['logged']) || !isset($_SESSION['email']) 
        || !isset($_SESSION['token']) || !isset($_SESSION['otp'])
        || $_SESSION['token'] != $_GET['token']
        || (!$_SESSION['logged'] || !$_SESSION['otp']))
    {    
        header('Location: services/auth.php?a=logout');
    }
?>