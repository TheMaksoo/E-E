<?php 
	include_once 'header.php';
	?>	


<div class="reset-password-body">
	<div class="container">
		<div class="reset-password-form-container reset-password-container">
			<form class="form-reset-password" action="includes/reset-request.inc.php" method="POST">
			<?php
			if(isset($_GET["reset"])) {
				if ($_GET["reset"] == "succes") {
					echo "<h2>Email has been sent!</h2><br>";
					include_once 'includes/reset-request.inc.php';
					echo $_SESSION['url'];
					
				}
				
			}
			else {
				?>
				<h1>Reset Password</h1>
				<h2>Fill in your email to reset your password.</h2>
			
				<input type="email" name="email" placeholder="Email...">
				<button type="submit" name="reset-request-submit">Reset Password</button>
				<?php
			}	
			
			?>
				
			</form>
		</div>
	</div>
</div>



<?php
	include_once 'footer.php';
?>