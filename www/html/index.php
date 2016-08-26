<!DOCTYPE html>
<html>
    <head>
        <title>Council of One</title>
        <?php
            include('../php/head.php');
        ?>
        <style>
            html {
                height: 100%;
            }

            body {
                background-color: #E7E7E7;
                height: 100%;
            }

            .post {
                background-color: #FFFFFF;
                border-radius: 16px;
                width: 100%;
            }

            .glyphicon-option-horizontal {
                display: block;
                text-align: center;
                color: #555555;
                font-size: 2.5em;
            }

            h2>a:hover {
                color: #FF0000;
            }

            .glyphicon-link {
                color: #555555;
                font-size: 16px;
            }

            .glyphicon-link:hover, .glyphicon-link:hover * {
                text-decoration: none;
                border-bottom: 4px solid #23527C;
            }

            .holder {
                overflow: hidden;
                height: 100%;
                will-change: scroll-position;
            }

            .content {
                overflow: hidden;
                height: 100%;
            }

            .content:hover {
                overflow-y: scroll;
            }

            .posts {
                width: 50vw;
            }

            .sidebar {
                background-color: #555555;
                width: 16.66666667%;
                overflow: hidden;
                height: 100%;
                padding-left: 0px;
                padding-right: 0px;
            }

            .sidebar:hover {
                overflow-y: scroll;
            }

            .post-list {
                list-style: none;
                padding-left: 0px;
            }

            .post-list>li {
                width: 100%;
                height: 2em;
                padding-left: 16px;
            }

            .post-list>li:hover {
                background-color: #333333;
            }

            .post-list>li>a {
                width: 100%;
                height: 100%;
                line-height: 100%;
                display: inline-block;
                padding-top: .4em;
                overflow: hidden;
                white-space: nowrap;
                background: linear-gradient(to right, rgba(255, 255, 255, 1) 75%, rgba(255, 255, 255, 0) 95%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body>
        <?php
            $page = 'home';
            //include('../php/nav.php');
        ?>
 
        <div class='holder'>
            <div class='container col-md-10 content'>
            <?php
                include('../php/nav.php');
            ?>
            <div class='container col-md-offset-2 posts'>
            <?php

                include('../php/sqlconnect.php');

                $sql = 'select * from Posts join Post_Content on Posts.ID=Post_Content.ID ORDER BY Posts.ID DESC;';
                $result = $conn->query($sql);

                $posts = "";
                while ($post = $result->fetch_assoc()) {
                    $posts .= "
                        <div class='container post' id='".$post['ID']."'>
                            <h2>"
                                .$post['Title']."
                                <a href='posts/".$post['ID'].".html'>
                                    <span class='glyphicon glyphicon-link' aria-hidden='true'></span>
                                </a>
                            </h2>
                            <h5>".$post['Author']." on ".$post['Created']."</h5>
                            <br>
                            <p>".$post['Content']."</p>
                        </div>
                        <div class=''>
                            <span class='glyphicon glyphicon-option-horizontal'></span>
                        </div>";
                }

                echo $posts;
?>
            </div>
            </div>
            <div class='container sidebar'>
                <ul class='post-list'>
                    <?php
                        $sql = 'select ID,Title from Posts ORDER BY ID DESC;';
                        $result = $conn->query($sql);

                        $titles = '';
                        while ($title = $result->fetch_assoc()) {
                            $titles .= "
                                <li><a href='#".$title['ID']."'>".$title['Title']."</a></li>";
                        }

                        echo $titles;
                    ?>
                </ul>
            </div>
        </div>
    </body>
</html>
