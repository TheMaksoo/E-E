<?php 
	include_once 'header.php';
	?>	

<div class="reset-password-body">
	<div class="container">
		<div class="reset-password-form-container reset-password-container">
			<form class="form-reset-password" action="includes/reset-password.inc.php" method="POST">
                <?php
                    $selector = $_GET["selector"];
                    $validator = $_GET["validator"];

                    if (empty($selector) || empty($validator)) {
                        echo "Could not validate your request!";
                    }
                    else { 
                        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                        ?>
                        <form class="form-reset-password" action="includes/reset-password.inc.php" method="POST">
                            <h1>Reset Password</h1>
                            <h2>Fill in your new password.</h2>
                            <input type="hidden" name= "selector" value="<?php echo $selector; ?>">
                            <input type="hidden" name= "validator" value="<?php echo $validator; ?>">
                            <input type="password" name="pwd" placeholder="New password...">
                            <input type="password" name="rpwd" placeholder="repeat New password...">
                            <button type="submit" name="reset-password.inc">Reset Password</button>
                        </form>
                            <?php
                        }
                    }
                    ?>
				
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');

	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
</script>

<?php
	include_once 'footer.php';
?>