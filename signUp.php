<?php


$msgBox = '';


//include notification page
include('includes/notification.php');

//Include Function page
include('includes/Functions.php');

include('includes/db.php');

//User Signup
if(isset($_POST['signup'])){
	if($_POST['email'] == '' || $_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['password'] == '' || $_POST['rpassword'] == '') {
				$msgBox = alertBox($SignUpEmpty);
			} else if($_POST['password'] != $_POST['rpassword']) {
				$msgBox = alertBox($PwdNotSame);
				
			} else {
				// Set new account
				$Email 		= $mysqli->real_escape_string($_POST['email']);
				$Password 	= encryptIt($_POST['password']);
				$FirstName	= $mysqli->real_escape_string($_POST['firstname']);
				$LastName	= $mysqli->real_escape_string($_POST['lastname']);
				$Currency	= $mysqli->real_escape_string($_POST['currency']);
				
				//Check if already register

				$sql="Select Email from user Where Email = '$Email'";

				 $c= mysqli_query($mysqli, $sql);

                    if (mysqli_num_rows($c) >= 1) {

                        $msgBox = alertBox($AlreadyRegister);
                    }
                    else{

				// add new account
				$sql="INSERT INTO user (FirstName, LastName, Email, Password, Currency) VALUES (?,?,?,?,?)";
				if($statement = $mysqli->prepare($sql)){
					//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
					$statement->bind_param('sssss', $FirstName, $LastName, $Email, $Password, $Currency);	
					$statement->execute();
				}
				$msgBox = alertBox($SuccessAccount);
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
				<a class="navbar-brand" href="index.html"><img class="logo" src="images/logo.png"></a>
			</div>
		</nav>
	</div>
</div>
<div class="container-fluid header-img">
	<div class="row">
		<img src="images/header-image.png">
	</div>
</div>
<div class="container-fluid regs-content">
	<div class="row">
		<div>
                    <div class="panel-body">
						<?php if ($msgBox) { echo $msgBox; } ?>
                        <form id="test-form" method="post" action="" role="form">
                        	<h1>Регистрация</h1>
                            <input placeholder="<?php  echo $Emails; ?>" name="email" type="email" autofocus>
                            <input placeholder="<?php  echo $FirstNames; ?>" name="firstname" type="text" >
                            <input placeholder="<?php  echo $LastNames; ?>" name="lastname" type="text" >
                                
                                    
                                    <select class="form-control bold"  name="currency">
										<option selected="" value="лв">Български лев (BGN)</option>
										<option value="€">Евро (€)</option>
										<option value="$">Долар ($)</option>
									</select>
                                
                                    <input placeholder="<?php  echo $Passwords; ?>" name="password" type="password" value="">
                               <input placeholder="<?php  echo $RepeatPassword; ?>" name="rpassword" type="password" value="">
                               
                                <button class="registration" type="submit" name="signup"><?php  echo $Save; ?></button>                                 <hr>
                               
                        </form>
                    </div>
		</div>
	</div>
</div>
<div class="container-fluid footer">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<footer>
					<h4>&copy;&nbsp;2015 Finconsult</h4>
				</footer>
			</div>
			<div class="col-md-6 col-sm-12">
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

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script src="js/parallax.min.js"></script>
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
