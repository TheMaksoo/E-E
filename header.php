<?php
	session_start();
?>

<html>
	<head>
		<title>EarningsAndExpenses</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="background">
		<div class="navbody">
			<div class="topnav">
				<?php
				if (isset($_SESSION["useruid"])) {
					echo "<a href='index.php'>Mainpage</a>";
					echo "<a href='homepage.php'>home</a>";
					echo "<a href='account.php'>account</a>";
					if ($_SESSION["useruid"] === "TheMaksoo") {
						echo "<a href='secret.homepage.php'>Big UwU</a>";
					}
					echo "<a href='includes/logout.inc.php'>logout</a>";
					
				}
				else { 
					echo "<a href='index.php'>Mainpage</a>";
					echo "<a href='loginpage.php'>Login</a>";
				}
				?>
				
			</div>
		</div>
	</body>