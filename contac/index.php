<!DOCTYPE HTML>
<html>
    <head>
        <title>Fianza LTDA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="public/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="public/css/style.css" rel='stylesheet' type='text/css' />
        <link href="public/css/font-awesome.css" rel="stylesheet"> 
        <link rel="stylesheet" href="public/css/icon-font.min.css" type='text/css' />
        <link href="public/css/animate.css" rel="stylesheet" type="text/css" media="all">
        <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    </head> 
    <body class="sign-in-up">
        <section>
            <div class="sign-in-wrapper">
                <!--<img src="public/images/logo_fianza-01.png">-->
                <div class="graphs" style="text-align: center;">
                    <div class="sign-in-form">
                        <div class="sign-in-form-top">
                            <img src="public/images/logo_fianza-01.png" style="width: 80%; height: 80%;">
                        </div>
                        <div class="signin">
                            <form action="Login.php" method="POST">
                                <!--<div class="log-input">-->
                                <div class="log-input">
                                    <input type="text" class="user" name="usuario" placeholder="Usuario" required="true"/>
                                </div>
                                <!--</div>--
                                <!--<div class="log-input">-->
                                <div class="log-input">
                                    <input type="password" name="password" class="lock" placeholder="Password" required="true"/>
                                </div>
                                <!--</div>-->
                                <p>
                                    <input type="submit" value="Ingresar" style="width: 100%;">
                                </p>
                            </form>	 
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p> <?php echo date('Y'); ?> FIANZA LTDA</p>
            </footer>
        </section>
        <script src="public/js/jquery-1.10.2.min.js"></script>
        <script>new WOW().init();</script>
        <script src="js/jquery.nicescroll.js"></script>
        <!--<script src="js/scripts.js"></script>-->
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>