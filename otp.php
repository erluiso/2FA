<?php
    session_start();

    if((!isset($_SESSION['logged']) || !isset($_SESSION['email']) || !isset($_SESSION['token']) || !isset($_SESSION['code'])))
		|| ($_SESSION['token'] != $_GET['token'])
		|| (!$_SESSION['logged'] || $_SESSION['from'] != "login" || strlen($_SESSION['code']) == 0)
		|| (time() > $_SESSION['expired'])
    {
        header('Location: services/auth.php?a=logout');
    }
    else
    {
?>
    <html>
        <head>
            <link rel="stylesheet" href="assets/styles/index.css">
        </head>
        <body>
            <div id="root">
                <div class="login-logo">
                    <!-- Your logo here -->
                </div>
                <div class="login-right-column">
                    <div class="login-form-content">
                        <div class="logo-mobile">
                            <!-- Your logo here -->
                        </div>
                        <div class="login-label-container">
                            <span class="login-label-login">Enter the OTP</span>
                        </div>
                        <div class="login-label-container">
                            <span class="twofa-sreen-desc">A 6-digit one time password (OTP) has been sent to your number +34 68* *** *76</span>
                        </div>
                        <div class="login-label-container">
                            <span class="twofa-seconds-desc">
                                You have <span id="seconds" style="color:#589BF3;"></span> to enter de code.
                            </span>
                        </div>
                        <form action="services/auth.php?token=<?php echo $_GET['token']?>&a=otp" method="POST" id="form">
                            <div class="login-input-container">
                                <table class="mt30px">
                                    <tr>
                                        <td class="p5px"><input name="1" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                        <td class="p5px"><input name="2" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                        <td class="p5px"><input name="3" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                        <td><span class="twofa-sreen-desc">-</span></td>
                                        <td class="p5px"><input name="4" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                        <td class="p5px"><input name="5" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                        <td class="p5px"><input name="6" type="text" maxlength="1" class="twofa-input-otp"/></td>
                                    <tr>
                                </table>
                            </div>
                            <div class="login-input-container">
                                <div class="login-options-container">
                                    <input type="checkbox" name="remember"/><span class="login-remember">Remember this device</span>
                                </div>
                                <div class="login-options-container">
                                    <span class="login-trouble">Trouble signing in?</span>
                                </div>
                            </div>
                            <div class="login-input-container mt15px">
                                <button id="sendForm" class="login-disabled-button">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script> let seconds = <?php echo $_SESSION['expired'] - time(); ?>;</script>
            <script src="assets/jscript/otp.js"></script>
        </body>
    </html>
<?php }?>