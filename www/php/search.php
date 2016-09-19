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

    if (!isset($_GET['s']) or $_GET['s'] == '') {
        $sql = 'SELECT ID,Title,Content FROM Posts ORDER BY ID DESC;';
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
        $expanded = " aria-expanded='true'";
        $edge = "4";
        while ($post = $result->fetch_assoc()) {
            $posts .= "
                <div class='result-holder col-xs-12'>
                    <div class='result panel panel-default col-xs-11' style='border-bottom-right-radius:".$edge."px'>
                        <div data-toggle='collapse' data-parent='#posts' href='#".$post['ID']."' class='panel-heading' onclick='dullEdge(this);'".$expanded.">
                            <div class='result-header row'>
                                <h4 class='col-sm-12'>".$post['Title']."</h4>
                            </div>
                        </div>
                        <div class='".$in."panel-collapse collapse' id='".$post['ID']."'>
                            <div class='panel-body'>".truncate($post['Content'],500)."</div>
                        </div>
                    </div>
                    <a class='post-link' href='posts.php?ID=".$post['ID']."'>
                        <i class='glyphicon glyphicon-arrow-right'></i>
                    </a>
                </div>";

            $in = "";
            $expanded = "";
            $edge = "0";
        }

        echo $posts;
    } else {
        echo "
            <div class='no-results'>
                <h3>No Results</h3>
            </div>";
    }
?>