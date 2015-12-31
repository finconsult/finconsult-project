<?php

$msgBox = '';


//include notification page
include ('includes/notification.php');

//Include db Page
include ('includes/db.php');

//Include Function page
include ('includes/Functions.php');

//User Login

if (isset($_POST['login'])) {
    if ($_POST['email'] == '') {
        $msgBox = alertBox($EmailEmpty);
    } else
        if ($_POST['password'] == '') {
            $msgBox = alertBox($PasswordEmpty);

        } else {
            // Get User Info
            $Email = $mysqli->real_escape_string($_POST['email']);
            $Password = encryptIt($_POST['password']);

            if ($stmt = $mysqli->prepare("SELECT UserId, FirstName, LastName, Email, Password, Currency from user WHERE Email = ? AND Password = ? ")) {
                $stmt->bind_param("ss", $Email, $Password);
                $stmt->execute();
                $stmt->bind_result($UserId_, $FirstName_, $LastName_, $Email_, $Password_, $Currency_);
                $stmt->store_result();
                $stmt->fetch();
                if ($num_of_rows = $stmt->num_rows >= 1) {
                    session_start();
                    $_SESSION['UserId'] = $UserId_;
                    $_SESSION['FirstName'] = $FirstName_;
                    $_SESSION['LastName'] = $LastName_;
                    $_SESSION['Currency'] = $Currency_;
                    $UserIds = $_SESSION['UserId'];


                    // Generate default Category for New User
                    $a = "SELECT CategoryName FROM category WHERE UserId = $UserIds";
                    $b = mysqli_query($mysqli, $a);
					mysqli_set_charset($mysqli, "utf8");
                    if (mysqli_num_rows($b) >= 1) {
                      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
                    } else {
                        $c = "INSERT INTO category(UserId, CategoryName, Level) VALUES ($UserIds, 'Заплати', 1), ($UserIds, 'Други', 1), ($UserIds, 'Преводи', 1), ($UserIds, 'Бонус', 1), ($UserIds, 'Храна', 2),
												 ($UserIds, 'Социален живот', 2), ($UserIds, 'Фрийланс', 2), ($UserIds, 'Транспорт', 2), ($UserIds, 'Култура', 2), ($UserIds, 'Дом', 2), ($UserIds, 'Облекло', 2), 
												 ($UserIds, 'Красота', 2), ($UserIds, 'Здраве', 2), ($UserIds, 'Подаръци', 2)";
                        $d = mysqli_query($mysqli, $c);
                    }
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
                } else {
                    $msgBox = alertBox($LoginError);
                }
            }
        }

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Управлявайте активите си Умно! Следете приходите и разходите си, балансирайте ги умело, добавяйте спестявания и плащайте сметките си навареме. Сега - по-лесно от всякога. ">
    <meta name="author" content="Finconsult team">
    <meta name="keywords" content="finconsult, финконсулт, финанси, приходи, разходи, спестявания, финансова статистика, управление, спестяване, статистика, балансиране, организиране">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="archive">
    <meta property="og:title" content="Finconsult :: Управлявайте активите си Умно" />
    <meta property="og:image" content="http://finconsult-bg.tk/images/ogimage.png" />
    <meta property="og:url" content="http://www.finconsult-bg.tk" />
    <meta property="og:description" content="Управлявайте активите си Умно! Следете приходите и разходите си, балансирайте ги умело, добавяйте спестявания и плащайте сметките си навареме. Сега - по-лесно от всякога." />
    <title>Finconsult :: Управлявайте активите си Умно</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!--Owl carousel-->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
   <div class="loader"></div>
<div class="container-fluid menu">
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img class="logo" src="images/logo.png"></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="log">Вход</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid header-img">
    <div class="row">
        <div class="col-md-12">
            <img src="images/header-image.png">
        </div>
    </div>
</div>
<div class="container-fluid row-one">
    <div class="container">
        <div class="row content-rows">
            <div class="col-md-5">
                <img src="images/cont-frtimg.png">
            </div>
            <div class="col-md-7">
                <h1>Организирайте парите си</h1>
                <p>
                Сигурно ти се е случвало да изпаднеш в патовата ситуация на „празният портфейл“, когато имаш още плащания, а нямаш вече средства. И какво? Ако си спестил нещо, добре, ще си помогнеш, а ако не...? Как и кога свършиха? Е, ние може би можем да ти предложим решение, което да дисциплинира разходите ти, да систематизира плащанията ти и да ти помогне да заделяш по нещо за трудни дни или за сбъднати мечти.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid row-two">
    <div class="container">
        <div class="row content-rows">
            <div class="col-md-5 hidden-col">
                <img src="images/cont-scndimg.png">
            </div>
            <div class="col-md-7">
                <h1>Балансизайте вашите приходи и разходи</h1>
                <p>
                Блансирай умело между приходите и разходите и не забравяй, че разходите не бива да надвишават приходите ти. Планирай своите плащания, ограничи и разпредели във времето домакинските и лични нужди, предвиди нещо непредвидено. За тези твои нужди ние от Finconsult имаме подходящо решение.
                </p>
            </div>
            <div class="col-md-5 img-col">
                <img src="images/cont-scndimg.png">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid row-three">
    <div class="container">
        <div class="row content-rows">
            <div class="col-md-5">
                <img src="images/cont-thrdimg.png">
            </div>
            <div class="col-md-7">
                <h1>Спестете пари</h1>
                <p>
                Спести пари днес, помогни на себе си утре. Когато правиш баланса на своите средства скрий от себе си сума, която желаеш и не я използвай, ако не ти се налага. Помогни си да сбъднеш някоя своя мечта. Колкото повече успееш да спестиш, толкова по-голяма мечта ще успееш да сбъднеш. Екипът на Finconsult ти желае успех!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid row-four">
    <div class="container">
        <div class="row content-rows">
            <div class="col-md-5 hidden-col">
                <img src="images/cont-frthimg.png">
            </div>
            <div class="col-md-7">
                <h1>Плащайте сметките си навреме</h1>
                <p>
                Плащането на сметките е задължение, което не можем да пропуснем, но можем да избегнем наказателните лихви и натрупаните дължими суми. Ние ви предлагаме да планувате плащанията си така, че да не нарушавате баланса на своите финанси.
                </p>
            </div>
            <div class="col-md-5 img-col">
                <img src="images/cont-frthimg.png">
            </div>
        </div>
    </div>
</div>
<!-- team information -->
<div class="container-fluid team">
    <h1 class="members-title">Нашият екип</h1>
    <div class="container members">
        <div>
            <img src="images/developer.png">
            <h1>Алекса Тачев</h1>
            <h5>Frontend developer</h5>
        </div>
        <div>
            <img src="images/designer.png">
            <h1>Виктория Райчева</h1>
            <h5>Graphic designer</h5>
        </div>
        <div>
            <img src="images/backdeveloper.png">
            <h1>Николай Чочев</h1>
            <h5>Backend developer</h5>
        </div>
    </div>
    <!-- team information responsive slider -->
    <div class="container hidden-members">
        <div class="item">
            <img src="images/developer.png">
            <h1>Алекса Тачев</h1>
            <h5>Frontend developer</h5>
        </div>
        <div class="item">
            <img src="images/designer.png">
            <h1>Виктория Райчева</h1>
            <h5>Graphic designer</h5>
        </div>
        <div class="item">
            <img src="images/backdeveloper.png">
            <h1>Николай Чочев</h1>
            <h5>Backend developer</h5>
        </div>
    </div>
</div>

  <div class="container-fluid login-form">
    <div class="login">
    <?php if ($msgBox) {
    echo $msgBox;
} ?>
        <h1>Организирайте парите си сега</h1>
        <form method="post" action="" role="form">
        <h4>Вход</h4>
                            <label><input placeholder="<?php echo
$Emails; ?>" name="email" type="email"></label>
                               <label><input placeholder="<?php echo
$Passwords; ?>" name="password" type="password" value=""></label>
                               
                                <button type="submit" name="login">Влизане</button><br>
            <span><a href="signUp.php">Регистрация на профил</a></span>
        </form>
    </div>
</div>
<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-5">
                <footer>
                    <h4>&copy;&nbsp;2015 Finconsult</h4>
                </footer>
            </div>
            <div class="col-md-6 col-sm-5">
                <ul class="footer-socials">
                    <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                    <li><a href="#"><i class="fa fa-github-square"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<a href="#" class="top-btn"><i class="fa fa-arrow-up"></i></a>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/main-script.js"></script>
    <script>
    $(window).load(function() {
        $(".loader").fadeOut(1500);
    })
    $('.parallax-window').parallax({imageSrc: 'images/image.png'});
    </script>
    <script>
    //to the top button script          
    $(document).ready(function() {
        var offset = 220;
        var duration = 1000;
        $(window).scroll(function() {
            if ($(this).scrollTop() > offset) {
                $('.top-btn').fadeIn(duration);
            } else {
                $('.top-btn').fadeOut(duration);
            }
        });
        $('.top-btn').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })
    });
    //end to the top button script
    </script>

</body>

</html>
