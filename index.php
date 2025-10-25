<?php
    session_start();
    session_destroy();
    
    $error = false;
    if(isset($_GET["error"]) && $_GET["error"] == 1)
    {
        $error = true;

        if($_GET["code"] == "31") $errorMessage = "The email format in invalid";
        if($_GET["code"] == "47") $errorMessage = "The OTP time has expired.";
        if($_GET["code"] == "50") $errorMessage = "The user or password is incorrect. Please, try again";
        if($_GET["code"] == "12") $errorMessage = "The token is incorrect";
        if($_GET["code"] == "11") $errorMessage = "The OPT code is incorrect";
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="assets/styles/index.css">
    </head>
    <body>
        <div id="root">
            <div class="login-logo">
                <img id="logo" src="assets/images/logo.png"/>
            </div>
            <div class="login-right-column">
                <div class="login-form-content">
                    <div class="logo-mobile">
                        <img src="assets/images/logo.png"/>
                    </div>
                    <div class="login-label-container">
                        <span class="login-label-login">Log in</span>
                    </div>
                    <?php if($error){?>
                        <div class="login-label-container">
                            <div class="twofa-error-container">
                                <div class="twofa-error-icon-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--material-symbols iconify MuiBox-root aurora-1iahyoa" id="_r_hi_" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="#c8445b" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m0-4q.425 0 .713-.288T13 12V8q0-.425-.288-.712T12 7t-.712.288T11 8v4q0 .425.288.713T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"></path>
                                    </svg>
                                </div>
                                <div class="twofa-error-text-container">
                                    <?php echo $errorMessage;?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <form action="services/auth.php?a=login" method="POST" id="form">
                        <div class="login-input-container">
                            <span class="login-input-label">Email</span>
                            <input type="text" name="email" class="login-input-text"/>
                        </div>
                        <div class="login-input-container">
                            <span class="login-input-label">Password</span>
                            <input type="password" name="password" class="login-input-text"/>
                        </div>
                        <div class="login-input-container">
                            <button id="sendForm" class="login-disabled-button">Log in</button>
                        </div>
                    </form>
                    <div class="login-input-container">
                        <div class="login-options-container">
                            <input type="checkbox" name="remember"/><span class="login-remember">Remember this device</span>
                        </div>
                        <div class="login-options-container">
                            <span class="login-trouble">Trouble signing in?</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/jscript/index.js"></script>
    </body>
</html>