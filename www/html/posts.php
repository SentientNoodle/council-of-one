<!DOCTYPE html>
<html>
    <head>
        <title>Council of One</title>
        <?php
            include('../php/head.php');
        ?>
        <style>
            body {
                background-color: #E7E7E7;
            }
            
            .navbar-nav>li {
                text-align: center;
            }
            
            .post {
                background-color: #FFFFFF;
                border-radius: 16px;
            }
        </style>
    </head>
    <body>
        <?php
            function truncate($string,$length=100,$append="&hellip;") {
                $string = trim($string);

                if(strlen($string) > $length) {
                    $string = wordwrap($string, $length);
                    $string = explode("\n", $string, 2);
                    $string = $string[0] . $append;
                }

                return $string;
            }

            include('../php/nav.php');
            include('../php/sqlconnect.php');

            $sql = $conn->prepare('select * from Posts where ID=?;');
            $sql->bind_param('i',$_GET["ID"]);
            $sql->execute();
            $sql->bind_result($id,$title,$author,$created,$content);

            $posts = "";
            while ($sql->fetch()) {
                $posts .= "
                    <div class='container post col-lg-10 col-lg-offset-1' id='".$id."'>
                        <h2>".$title."</h2>
                        <h5>By ".$author." on ".truncate($created,10,'')."</h5>
                        <hr>
                        <p>".$content."</p>
                    </div>";
            }

            echo $posts;
        ?>
    </body>
</html>