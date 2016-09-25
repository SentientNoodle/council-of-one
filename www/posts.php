<?php
    if (isset($_POST)) {
        include('/home/ubuntu/workspace/php/updateWeight.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Council of One</title>
        <?php
            include('/home/ubuntu/workspace/php/head.php');
        ?>
        <link rel="stylesheet" href="css/posts.css">
    </head>
    <body>
        <?php
            include('/home/ubuntu/workspace/php/getPost.php');
        ?>
    </body>
</html>