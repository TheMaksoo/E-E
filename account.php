<?php
    include_once 'header.php';
    ?> 
<div class="indexbody">
    <?php
        if (isset($_SESSION["useruid"])) {
            echo "<h1>Hi " . $_SESSION["username"] ."!</h1>";
            echo "<h1>here gonna be ur account shizzles</h1>";
        }      
        ?>
    
</div>
<?php
    include_once 'footer.php';
    ?>