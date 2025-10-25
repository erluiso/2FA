<?php

    /**
     * Redirect with de error code to the initial page
     */
    function redirec($error=0, $errorCode=0)
    {
        session_start();
        session_destroy();
        header('Location: ../index.php?error='.$error.'&code='.$errorCode);
        exit;
    }

    if(!isset($_GET["a"]))
        redirec(1,50);

    switch($_GET["a"])
    {
        //Validates the login
        case "login":

            if($_SERVER['REQUEST_METHOD'] != 'POST'
                || !isset($_POST["email"])
                || !isset($_POST["password"])
				//Write your email 
                || $_POST["email"] != "" 
				//write your password encripted
                || !password_verify($_POST["password"], '$2y$10$hkK1gy34566ygfder5655hiw62.kPYvOrv1svNdLhE6fnCvAKMy'))
            {
                redirec(1,50);
            }
            
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                redirec(1,31);

            session_start();
            session_regenerate_id();
            $_SESSION['logged']  = true;
            $_SESSION['from']    = "login";
            $_SESSION['email']   = $_POST['email'];
            $_SESSION['token']   = bin2hex(random_bytes(32));
            $_SESSION['code']    = rand(100,999)."-".rand(100,999);
            $_SESSION['expired'] = time() + 120;

            $message = "Verification code: ".$_SESSION['code'].".";
            $message .= "The code is valid for 2 minutes.";
            $message .= "Do not share this code with anyone.";

            $token  = ""; //Write your Telegram token
            $chatId = ""; //Write your Telegram chatId

            file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatId."&text=".urlencode($message));
            header('Location: ../otp.php?token='.$_SESSION['token']);
            break;

        //Validates the opt code
        case "otp":

            session_start();

            if($_SESSION['token'] != $_GET['token'])
                redirec(1,12);

            if($_SERVER['REQUEST_METHOD'] != 'POST' 
                || !isset($_POST["1"]) || !isset($_POST["2"]) 
                || !isset($_POST["3"]) || !isset($_POST["4"]) 
                || !isset($_POST["5"]) || !isset($_POST["6"]))
            {
                redirec(1,11);
            }
            
            $codeReceived = $_POST["1"].$_POST["2"].$_POST["3"]."-".$_POST["4"].$_POST["5"].$_POST["6"];

            if($codeReceived != $_SESSION['code'])
                redirec(1,11);

            session_cache_expire(10);
            $_SESSION['otp'] = true;
            header('Location: ../controlPanel.php?token='.$_SESSION['token']."&page=home");
            break;

        //Logout
        case "logout":
            redirec();
            break;
        
        //The rest
        default:
            redirec();
            break;
    }
?>