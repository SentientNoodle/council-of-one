<!DOCTYPE HTML>
<html>
<head>
    <?php
        include('../php/head.php');
    ?>
    <style>
        body {
            overflow: hidden;
            background-color: #E7E7E7;
        }

        .postbox {
            background-color: #555555;
            height: calc(100vh - 70px);
        }

        .postbox:hover {
            overflow-y: auto;
        }

        .search {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .result {
            cursor: pointer;
        }

        .result > .panel-heading {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .result-header {
            display: flex;
            align-items: stretch;
            align-content: center;
        }

        .result-header > h4 {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .result-header > a {
            display: flex;
            align-self: stretch;
            flex: 1;
            border-left: #CCCCCC solid 2px;
            z-index: 2147483647;
        }

        .result-header > a:hover {
            background: #CCCCCC;
            text-decoration: none;
        }

        .result-header > a:focus {
            text-decoration: none;
        }

        .result-header > a > i {
            font-size: 1.5em;
            color: #555555;
            align-self: center;
        }

        .no-results {
            background: #FFFFFF;
            display: flex;
            align-content: center;
            align-self: stretch;
            flex: 1;
            border-radius: 4px;
        }

        .no-results > h3 {
            flex: 1;
            text-align: center;
        }
    </style>
</head>
<body>
        <?php
            $page = 'archive';
            include('../php/nav.php');
        ?>

        <div class='container'>
            <div class='postbox container col-md-8 col-md-offset-2'>
                <form class="search col-md-8 col-md-offset-2" role="search">
                    <div class="input-group add-on">
                    <input class="form-control" placeholder="Search" name="s" id="s" type="text" value="<?php if(isset($_GET['s'])) {echo htmlspecialchars($_GET['s']);} ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class='panel-group col-md-12' id='posts'>
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


                        include('../php/sqlconnect.php');

                        if (!isset($_GET['s'])) {
                            $sql = 'SELECT Posts.ID,Title,Content FROM Posts JOIN Post_Content ON Posts.ID=Post_Content.ID ORDER BY Posts.ID DESC;';
                            $result = $conn->query($sql);
                        } else {
                            $stopWords = array("a","about","above","after","again","against","all","am","an","and","any","are","aren't","as","at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could","couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from","further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her","here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in","into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor","not","of","off","on","once","only","or","other","ought","our","ours","ourselves","out","over","own","same","shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the","their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're","they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll","we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who","who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves");
                            $query = array_unique(explode(' ', trim(preg_replace("/[^A-Za-z0-9 ]/",'',$_GET['s']))));
                            for ($i = 0; $i < count($query); $i++) {
                                if (in_array($query[$i],$stopWords)) {
                                    unset($query[$i]);
                                }
                            }

                            $query = join(',',$query);

                            $sql = $conn->prepare('call Post_Search(?)');
                            $sql->bind_param('s',$query);
                            $sql->execute();

                            $sql = 'select * from scoreboard where score > 0 order by score desc, ID desc;';
                            $result = $conn->query($sql);
                        }

                        if ($result->num_rows > 0) {
                            $in = "in ";
                            $posts = "";
                            while ($post = $result->fetch_assoc()) {
                                $posts .= "
                                    <div class='result panel panel-default'>
                                        <div data-toggle='collapse' data-parent='#posts' href='#".$post['ID']."' class='panel-heading'>
                                            <div class='result-header row'>
                                                <h4 class='col-xs-11'>".$post['Title']."</h4>
                                                <a class='col-xs-1' href='/posts/".$post['ID'].".html'>
                                                    <i class='glyphicon glyphicon-arrow-right'></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class='".$in."panel-collapse collapse' id='".$post['ID']."'>
                                            <div class='panel-body'>".truncate($post['Content'],500)."</div>
                                        </div>
                                    </div>";

                                $in = "";
                            }

                            echo $posts;
                        } else {
                            echo "
                                <div class='no-results'>
                                    <h3>No Results</h3>
                                </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
</body>
</html>
