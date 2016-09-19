<!DOCTYPE html>
<html>
    <head>
        <?php
            include('../php/head.php');
        ?>
        <link rel="stylesheet" href="/www/css/archive.css">
        <script src="/www/js/archive.js"></script>
    </head>
    <body onresize='resizePostboxHeight();'>
        <?php
            $page = 'archive';
            include('../php/nav.php');
        ?>
        <div class='main container'>
            <div class='postbox container col-lg-8 col-lg-offset-2'>
                <form class="search col-lg-8 col-lg-offset-2" role="search">
                    <div class="input-group add-on">
                    <input class="form-control" placeholder="Search" name="s" id="s" type="text" value="<?php if(isset($_GET['s'])) {echo htmlspecialchars($_GET['s']);} ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class='panel-group col-md-12' id='posts'>
                    <?php
                        include('../php/search.php');
                    ?>
                    <script type="text/javascript">
                        postLinkHeight();
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>