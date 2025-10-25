<?php session_start();?>
<?php include("services/authChecker.php");?>

<?php if($_SESSION['logged'] && $_SESSION['otp']){?>
    <html>
        <head>
            <meta name="viewport">
            
            <meta http-equiv="Expires" content="0">
            <meta http-equiv="Last-Modified" content="0">
            <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
            <meta http-equiv="Pragma" content="no-cache">

            <link rel="stylesheet" href="assets/styles/fonts.css">
            <link rel="stylesheet" href="assets/styles/index.css">
            <link rel="stylesheet" href="assets/styles/header.css">
            <link rel="stylesheet" href="assets/styles/main.css">
            <link rel="stylesheet" href="assets/styles/left-menu.css">
            <link rel="stylesheet" href="assets/styles/<?php echo $_GET["page"]?>.css">
        </head>
        <body>
            <!-- Here your content -->
        </body>
    </html>
<?php }?>