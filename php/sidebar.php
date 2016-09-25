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