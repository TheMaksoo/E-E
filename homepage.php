<?php
    include_once 'header.php';
    ?> 
<div class="indexbody">
    <?php
        if (isset($_SESSION["useruid"])) {
            echo "<h1>Hi " . $_SESSION["useruid"] ."!</h1>";
            echo "<h1>here are your earnings and expenses.</h1>";
        }      
        ?>
    <h1> ur logged in fam</h1>
</div>
<?php
    include_once 'footer.php';
    ?>