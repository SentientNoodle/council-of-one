<!DOCTYPE html>
<html>
    <head>
        <title>Council of One</title>
        <?php
            include('/home/ubuntu/workspace/php/head.php');
        ?>
        <link rel="stylesheet" href="/css/index.css">
    </head>
    <body>
        <?php
            $page = 'home';
        ?>
        <div class='holder'>
            <div class='container col-lg-10 content'>
                <?php
                    include('/home/ubuntu/workspace/php/nav.php');
                ?>
                <div class='container col-lg-offset-2 col-lg-8'>
                    <?php
                        include('/home/ubuntu/workspace/php/getAllPosts.php');
                    ?>
                </div>
            </div>
            <div class='container sidebar'>
                <ul class='post-list'>
                    <?php
                        include('/home/ubuntu/workspace/php/sidebar.php');
                    ?>
                </ul>
            </div>
        </div>
    </body>
</html>
