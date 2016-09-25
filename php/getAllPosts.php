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

    $sql = 'select * from Posts ORDER BY ID DESC;';
    $result = $conn->query($sql);

    $posts = "";
    while ($post = $result->fetch_assoc()) {
        $posts .= "
            <div class='container post' id='".$post['ID']."'>
                <h2>"
                    .$post['Title']."
                    <a href='posts.php?ID=".$post['ID']."'>
                        <span class='glyphicon glyphicon-link' aria-hidden='true'></span>
                    </a>
                </h2>
                <h5>By ".$post['Author']." on ".truncate($post['Created'],10,'')."</h5>
                <hr>
                <p>".$post['Content']."</p>
            </div>
            <div class=''>
                <span class='glyphicon glyphicon-option-horizontal'></span>
            </div>";
    }

    echo $posts;
?>