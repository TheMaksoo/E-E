<?php 
	include_once 'header.php';
	?>	

		<div class="loginbody">
		<?php
			if (isset($_GET["error"]) == "error") {
				echo "<h2>Error!<br>Something went wrong, try again!</h2> ";
			}	
			else if (isset($_GET["error"]) == "resetsucces") {
				echo "<h2>Password reset comeplete!<br>Try logging in again.</h2> ";
			}
			else if (isset($_GET["error"]) == "none") {		
			}
			?>
		<div class="container" id="container">

		<div class="form-container sign-up-container">
			<form action="includes/signup.inc.php" method="POST">
				<h1>Create Account</h1>
					<div class="social-container">
						<a href="#" class="social"><i class="fa fa-facebook"></i></a>
						<a href="#" class="social"><i class="fa fa-google"></i></a>
			
					</div>
				<span>or use your email for registration</span>
				<input type="email" name="email" placeholder="Email...">
				<input type="text" name="uid" placeholder="Username...">
				<input type="text" name="name" placeholder="Full Name...">
				<input type="password" name="pwd" placeholder="Password...">
				<input type="password" name="rpwd" placeholder="Repeat Password...">
				<button class= "normal" type="submit" name="submit">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="includes/login.inc.php" method="POST">
				<h1>Sign In</h1>
				<?php
					if(isset($_GET["error"])) {
						if ($_GET["error"] == "emptylogininput") {
							echo "<h2>Error!<br>Fill in all fields!</h2>";
						}
						else if ($_GET["error"] == "wronglogin") {
							echo "<h2>Error!<br>Wrong login info.</h2>";
						}
						else if ($_GET["error"] == "none") {		
						}
					}
				?>
				<div class="social-container">
					<a href="#" class="social"><i class="fa fa-facebook"></i></a>
					<a href="#" class="social"><i class="fa fa-google"></i></a>
				</div>
				<span>or use your account</span>
				<input type="text" name="uid" placeholder="Username/Email...">
				<input type="password" name="password" placeholder="Password...">
				<a href="reset-password.php">Forgot Your Password?</a>
				<button class= "normal" type="submit" name="submit">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>Login with your username and password</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1><br>
					<?php
						if(isset($_GET["error"])) {
							if ($_GET["error"] == "emptyinput") {
								echo "<h2>Error!<br>Fill in all fields!</h2>";
							}
							else if ($_GET["error"] == "emptyuid") {
								echo "<h2>Error!<br>Choose a proper username!</h2>";
							}
							else if ($_GET["error"] == "invalidemail") {
								echo "<h2>Error!<br>Choose a proper email!</h2>";
							}
							else if ($_GET["error"] == "emptypasswordsdontmatch") {
								echo "<h2>Error!<br>Passwords don't match!</h2>";
							}
							else if ($_GET["error"] == "usernametaken") {
								echo "<h2>Error!<br>Username already exists!</h2>";
							}
							else if ($_GET["error"] == "statementfailed") {
								echo "<h2>Error!<br>Something went wrong, try again!</h2>";
							}
							else if ($_GET["error"] == "none") {
								
							}
						}
					?>
					<p>Create your free account!</p>
					
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
		</div>
		</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>




<?php
	include_once 'footer.php';
?>