<?php
include ('includes/notification.php');
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
    <title>Finconsult :: Управлявайте активите си Умно!</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--Owl carousel-->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">
    <!-- main styles and fonts -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <script src="js/jquery-1.11.0.js"></script>
     <script src="js/plugins/metisMenu/metisMenu.js"></script>
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
					<li <?php ActiveClass("index");?>><a href="index.php">Начало</a></li>
					<li <?php ActiveClass("index.php?page=AssetReport");?>><a href="index.php?page=AssetReport">Приходи</a></li>
					<li <?php ActiveClass("index.php?page=ExpenseReport");?>><a href="index.php?page=ExpenseReport">Разходи</a></li>
					<li <?php ActiveClass("index.php?page=IncomeVsExpense");?>><a href="index.php?page=IncomeVsExpense">Приходи Vs. Разходи</a></li>
					<li <?php ActiveClass("index.php?page=ManageBudget");?>><a href="index.php?page=ManageBudget">Бюджети</a></li>
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- dropdown notifications -->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
					<li><a href="#" class="btn btn-primary dropdown-toggle user-log" data-toggle="dropdown"><i class="fa fa-user"></i></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?page=dashboard"><i class="fa fa-bar-chart"></i>&nbsp;Статистика</a></li>
							<li><a href="index.php?page=Settings"><i class="fa fa-cog"></i>&nbsp;Настройки</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="index.php?action=logout"><i class="fa fa-sign-out"></i>&nbsp;Изход</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
    <div id="wrapper-head">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="headmain">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".mainnavv">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Управлявай парите си интелигентно.</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                     <?php 
                    echo $Welcome;?>, 
                    <?php 
                    echo $ColUser['FirstName'];?>
                </li>
                
            </ul>
            <!-- /.navbar-top-links -->
        </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse mainnavv">
                    <ul class="nav font-sidebar" id="side-menu">
                      
                        <li>
                            <a <?php ActiveClass("index");?> href="index.php"><i class="glyphicon glyphicon-home"></i>  <?php echo $Dashboard;?><span class="fa arrow"></a>
                        </li>
                        <li>
                            <a <?php ActiveClass("index.php?page=Transaction");?>  href="index.php?page=Transaction"><i class="glyphicon glyphicon-refresh"></i>  <?php echo $Transaction;?><span class="fa arrow"></a>
                        </li>
                        <li>
                            <a <?php ActiveClass("index.php?page=AssetReport");?> href="index.php?page=AssetReport"><i class="glyphicon glyphicon-stats"></i>  <?php echo $Incomes;?><span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a <?php ActiveClass("index.php?page=ExpenseReport");?> href="index.php?page=ExpenseReport" ><i class="glyphicon glyphicon-list-alt"></i> <?php echo $Expenses;?><span class="fa arrow"></span></a>
                        <li>    
                                
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageAccount");?> href="index.php?page=ManageAccount"> <i class="fa fa-tags"></i> <?php echo $Account;?><span class="fa arrow"></a>
                                </li>
                         
                            <!-- /.nav-second-level -->
                    

                                    
                        </li>                           
                        </li>
                        <li><a <?php ActiveClass("index.php?page=ManageBudget");?> href="index.php?page=ManageBudget"><i class="fa fa-archive"></i> <?php echo $BudgetsM;?><span class="fa arrow"></a>
                        </li>
                        
                    <li>
                        <a class="parent" href="javascript:void(0)"><i class="fa fa-gears"> </i> <?php echo $Settings;?><span class="fa arrow"></a>
                        <ul class="nav nav-second-level" id="subitem">
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageExpenseCategory");?> href="index.php?page=ManageExpenseCategory"><i class="fa fa-caret-right"></i> <?php echo $CategoryExpense;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageIncomeCategory");?> href="index.php?page=ManageIncomeCategory"><i class="fa fa-caret-right"></i> <?php echo $CategoryIncome;?></a>
                                </li>
                                
                        </ul>
                    </li>

                    <li>
                         <a class="parent" href="javascript:void(0)"><i class="fa fa-print"> </i> <?php echo $ReportsGraphs;?><span class="fa arrow"></a>
                         <ul class="nav nav-second-level" >
                                <li>
                                    <a <?php ActiveClass("index.php?page=IncomeVsExpense");?> id="subitem" href="index.php?page=IncomeVsExpense"><i class="fa fa-caret-right"> </i> <?php echo $IncomeVsExpense;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=IncomeCalender");?> id="subitem" href="index.php?page=IncomeCalender"><i class="fa fa-caret-right"> </i> <?php echo $IncomeCalender;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=ExpenseCalender");?> id="subitem" href="index.php?page=ExpenseCalender"><i class="fa fa-caret-right"> </i> <?php echo $ExpenseCalender;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=AllIncomeReports");?> id="subitem" href="index.php?page=AllIncomeReports"><i class="fa fa-caret-right"></i> <?php echo $IncomeReportsM ;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=AllExpenseReports");?> id="subitem" href="index.php?page=AllExpenseReports"><i class="fa fa-caret-right"></i> <?php echo $ExpenseReportsM;?></a>
                                </li>
                                
                        </ul>
                    </li> 
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
</div>
<script>

$(document).ready(function () {
    $(this).parent().addClass("collapse");
    $(".parent").on('click', function () {
        $(this).parent().find("#subitem").slideToggle();
    });
});

</script>