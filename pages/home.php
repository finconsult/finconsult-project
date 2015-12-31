<?php

$msgBox='';
//Include Functions
include('includes/Functions.php');

//Include Notifications
include ('includes/notification.php');

// Get all Income
$GetAllIncome 	 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId";
$GetAIncome		 = mysqli_query($mysqli, $GetAllIncome);
$IncomeCol 		 = mysqli_fetch_assoc($GetAIncome);


// Get all Expense
$GetAllExpense   = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId";
$GetAExpense         = mysqli_query($mysqli, $GetAllExpense);
$ExpenseCol          = mysqli_fetch_assoc($GetAExpense);

//Count current totals Income
$CountTotals = $IncomeCol['Amount'] - $ExpenseCol['Amount'];

//Get Recent Income History
$GetIncomeHistory = "SELECT * from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where assets.UserId = $UserId ORDER BY assets.Date DESC LIMIT 10";
$IncomeHistory = mysqli_query($mysqli,$GetIncomeHistory); 

//Get Recent Expense History
$GetExpenseHistory = "SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = $UserId ORDER BY bills.Dates DESC LIMIT 10";
$ExpenseHistory = mysqli_query($mysqli,$GetExpenseHistory); 


// Get all by month Income
$GetAllIncomeDate 	 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND MONTH(Date) = MONTH (CURRENT_DATE())";
$GetAIncomeDate		 = mysqli_query($mysqli, $GetAllIncomeDate);
$IncomeColDate 		 = mysqli_fetch_assoc($GetAIncomeDate);

// Get all by month Expense
$GetAllExpenseDate 	 = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND MONTH(Dates) = MONTH (CURRENT_DATE())";
$GetAExpenseDate		 = mysqli_query($mysqli, $GetAllExpenseDate);
$ExpenseColDate 		 = mysqli_fetch_assoc($GetAExpenseDate);


// Budget Progress
$Getbudgets = "SELECT AmountIncome As Amount, (AmountIncome - AmountExpense) As Totals, AmountExpense/(AmountIncome - AmountExpense) * 100/100 AS Per,CategoryName
					  FROM ( SELECT  UserId,CategoryId, 
                      SUM(Amount) AS AmountExpense
                      FROM bills
				      GROUP BY CategoryId) AS b
					  LEFT JOIN ( SELECT  CategoryId,
                      SUM(Amount) AmountIncome
				      FROM budget WHERE MONTH(Dates) = MONTH (CURRENT_DATE())
					  GROUP BY CategoryId) AS a ON b.CategoryId = a.CategoryId
                      LEFT JOIN (SELECT CategoryId, CategoryName 
                      FROM category
                      GROUP BY CategoryId) AS c
					  ON b.CategoryId = c.CategoryId WHERE b.UserId = $UserId";
$Budgets = mysqli_query($mysqli, $Getbudgets);


?>

<div class="container-fluid header-img">
	<div class="row">
		<div class="parallax-window" data-parallax="scroll">
			<video src="video/movie.mp4" loop autoloop autoplay muted></video>
		</div>
		<div class="col-md-12 image-header">
			<img src="images/header-image.png">
		</div>
	</div>
</div>
<div class="container-fluid savings">
	<div class="container">
		<div class="row">
			<h1>Вашите спестявания</h1>
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-4 col-sm-5">
				<div class="money-mn-circle">
					<h1><?php echo number_format($CountTotals).' '. $ColUser['Currency'];?></h1>
				</div>
				<p>ТЕКУЩИ СПЕСТЯВАНИЯ</p>
			</div>
			<div class="col-md-4 col-sm-5">
				<div class="money-mn-circle mall">
					<h1><?php echo number_format($CountTotals) .' '. $ColUser['Currency'];?></h1>
				</div>
				<p>ВСИЧКИ СПЕСТЯВАНИЯ</p>
			</div>
			<div class="col-md-2 col-sm-2"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<a href="index.php?page=Transaction" class="saves-btn">Добави сума</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid rec-badges">
	<div class="container">
	<h1>Придобити значки</h1>
		<div class="row mybadges">
			<?php if(number_format($CountTotals)<99){
				?>
			<h4 style="color:green!important; margin-bottom: 55px;">Все още нямате придобити значки</h4>
				<?php };?>
			<?php if(number_format($CountTotals)>99){
				?>
			<div>
				<img src="images/badge_first.png">
				<h1>Първо<br> спестяване</h1>
				<h4>1/1</h4>
			</div>
			<div>
				<img src="images/badge_beginner.png">
				<h1>Начинаещ<br> потребител</h1>
				<h4>70/70</h4>
			</div>
			<div>
				<img src="images/badge_semi.png">
				<h1>Прохождащ<br> потребител</h1>
				<h4>100/100</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>99){
				?>
			<div>
				<img src="images/badge_100.png">
				<h1>Спестени<br> 100лв</h1>
				<h4>100/100</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>299){
				?>
			<div>
				<img src="images/badge_300.png">
				<h1>Спестени<br> 300лв</h1>
				<h4>300/300</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>499){
				?>
			<div>
				<img src="images/badge_500.png">
				<h1>Спестени<br> 500лв</h1>
				<h4>500/500</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>699){
				?>
			<div>
				<img src="images/badge_700.png">
				<h1>Спестени<br> 700лв</h1>
				<h4>700/700</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>999){
				?>
			<div>
				<img src="images/badge_1000.png">
				<h1>Спестени<br> 1000лв</h1>
				<h4>1000/1000</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1499){
				?>
			<div>
				<img src="images/badge_1500.png">
				<h1>Спестени<br> 1500лв</h1>
				<h4>1500/1500</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>399){
				?>
			<div>
				<img src="images/badge_good.png">
				<h1>Добър<br> спестовник</h1>
				<h4>400/400</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1699){
				?>
			<div>
				<img src="images/badge_grand.png">
				<h1>Велик<br> спестовник</h1>
				<h4>1700/1700</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1999){
				?>
			<div>
				<img src="images/badge_super.png">
				<h1>Супер<br> спестовник</h1>
				<h4>2000/2000</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>599){
				?>
			<div>
				<img src="images/badge_excellent.png">
				<h1>Отличен<br> спестовник</h1>
				<h4>600/600</h4>
			</div>
				<?php };?>
		</div>
		<div class="badges-hidden">
			<?php if(number_format($CountTotals)>99){
				?>
			<div>
				<img src="images/badge_first.png">
				<h1>Първо<br> спестяване</h1>
				<h4>1/1</h4>
			</div>
			<div>
				<img src="images/badge_beginner.png">
				<h1>Начинаещ<br> потребител</h1>
				<h4>70/70</h4>
			</div>
			<div>
				<img src="images/badge_semi.png">
				<h1>Прохождащ<br> потребител</h1>
				<h4>100/100</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>99){
				?>
			<div>
				<img src="images/badge_100.png">
				<h1>Спестени<br> 100лв</h1>
				<h4>100/100</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>299){
				?>
			<div>
				<img src="images/badge_300.png">
				<h1>Спестени<br> 300лв</h1>
				<h4>300/300</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>499){
				?>
			<div>
				<img src="images/badge_500.png">
				<h1>Спестени<br> 500лв</h1>
				<h4>500/500</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>699){
				?>
			<div>
				<img src="images/badge_700.png">
				<h1>Спестени<br> 700лв</h1>
				<h4>700/700</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>999){
				?>
			<div>
				<img src="images/badge_1000.png">
				<h1>Спестени<br> 1000лв</h1>
				<h4>1000/1000</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1499){
				?>
			<div>
				<img src="images/badge_1500.png">
				<h1>Спестени<br> 1500лв</h1>
				<h4>1500/1500</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>399){
				?>
			<div>
				<img src="images/badge_good.png">
				<h1>Добър<br> спестовник</h1>
				<h4>400/400</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1699){
				?>
			<div>
				<img src="images/badge_grand.png">
				<h1>Велик<br> спестовник</h1>
				<h4>1700/1700</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>1999){
				?>
			<div>
				<img src="images/badge_super.png">
				<h1>Супер<br> спестовник</h1>
				<h4>2000/2000</h4>
			</div>
				<?php };?>
				<?php if(number_format($CountTotals)>599){
				?>
			<div>
				<img src="images/badge_excellent.png">
				<h1>Отличен<br> спестовник</h1>
				<h4>600/600</h4>
			</div>
				<?php };?>
		</div>
	</div>
</div>
<div class="container-fluid all-badges">
	<div class="container">
	<h1>Всички значки</h1>
		<div class="row all-badges-hidden">
			<div>
				<img src="images/badge_first.png">
				<h1>Първо<br> спестяване</h1>
				<h4>0/1</h4>
			</div>
			<div>
				<img src="images/badge_beginner.png">
				<h1>Начинаещ<br> потребител</h1>
				<h4>0/70</h4>
			</div>
			<div>
				<img src="images/badge_semi.png">
				<h1>Прохождащ<br> потребител</h1>
				<h4>0/100</h4>
			</div>
			<div>
				<img src="images/badge_regular.png">
				<h1>Редовен<br> потребител</h1>
				<h4>0/600</h4>
			</div>
			<div>
				<img src="images/badge_special.png">
				<h1>Специален<br> потребител</h1>
				<h4>0/1700</h4>
			</div>
			<div>
				<img src="images/badge_100.png">
				<h1>Спестени<br> 100лв</h1>
				<h4>0/100</h4>
			</div>
			<div>
				<img src="images/badge_300.png">
				<h1>Спестени<br> 300лв</h1>
				<h4>0/300</h4>
			</div>
			<div>
				<img src="images/badge_500.png">
				<h1>Спестени<br> 500лв</h1>
				<h4>0/500</h4>
			</div>
			<div>
				<img src="images/badge_700.png">
				<h1>Спестени<br> 700лв</h1>
				<h4>0/700</h4>
			</div>
			<div>
				<img src="images/badge_1000.png">
				<h1>Спестени<br> 1000лв</h1>
				<h4>0/1000</h4>
			</div>
			<div>
				<img src="images/badge_1500.png">
				<h1>Спестени<br> 1500лв</h1>
				<h4>0/1500</h4>
			</div>
			<div>
				<img src="images/badge_good.png">
				<h1>Добър<br> спестовник</h1>
				<h4>0/400</h4>
			</div>
			<div>
				<img src="images/badge_excellent.png">
				<h1>Отличен<br> спестовник</h1>
				<h4>0/600</h4>
			</div>
			<div>
				<img src="images/badge_super.png">
				<h1>Супер<br> спестовник</h1>
				<h4>0/2000</h4>
			</div>
			<div>
				<img src="images/badge_grand.png">
				<h1>Велик<br> спестовник</h1>
				<h4>0/1700</h4>
			</div>
		</div>
		<!-- all badges responsive slider -->
		<div class="allbadges-gallery">
			<div>
				<img src="images/badge_first.png">
				<h1>Първо<br> спестяване</h1>
				<h4>0/1</h4>
			</div>
			<div>
				<img src="images/badge_beginner.png">
				<h1>Начинаещ<br> потребител</h1>
				<h4>0/70</h4>
			</div>
			<div>
				<img src="images/badge_semi.png">
				<h1>Прохождащ<br> потребител</h1>
				<h4>0/100</h4>
			</div>
			<div>
				<img src="images/badge_regular.png">
				<h1>Редовен<br> потребител</h1>
				<h4>0/600</h4>
			</div>
			<div>
				<img src="images/badge_special.png">
				<h1>Специален<br> потребител</h1>
				<h4>0/1700</h4>
			</div>
			<div>
				<img src="images/badge_100.png">
				<h1>Спестени<br> 100лв</h1>
				<h4>0/100</h4>
			</div>
			<div>
				<img src="images/badge_300.png">
				<h1>Спестени<br> 300лв</h1>
				<h4>0/300</h4>
			</div>
			<div>
				<img src="images/badge_500.png">
				<h1>Спестени<br> 500лв</h1>
				<h4>0/500</h4>
			</div>
			<div>
				<img src="images/badge_700.png">
				<h1>Спестени<br> 700лв</h1>
				<h4>0/700</h4>
			</div>
			<div>
				<img src="images/badge_1000.png">
				<h1>Спестени<br> 1000лв</h1>
				<h4>0/1000</h4>
			</div>
			<div>
				<img src="images/badge_1500.png">
				<h1>Спестени<br> 1500лв</h1>
				<h4>0/1500</h4>
			</div>
			<div>
				<img src="images/badge_good.png">
				<h1>Добър<br> спестовник</h1>
				<h4>0/400</h4>
			</div>
			<div>
				<img src="images/badge_excellent.png">
				<h1>Отличен<br> спестовник</h1>
				<h4>0/600</h4>
			</div>
			<div>
				<img src="images/badge_super.png">
				<h1>Супер<br> спестовник</h1><!--1 седмица-->
				<h4>0/2000</h4>
			</div>
			<div>
				<img src="images/badge_grand.png">
				<h1>Велик<br> спестовник</h1>
				<h4>0/1700</h4>
			</div>
		</div>
	</div>
</div>
<script>

$(document).ready(function () {
    $("#wrapper-head").hide();
});

</script>