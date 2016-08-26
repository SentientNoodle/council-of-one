<?php
    if ($page == 'home') {
        $home = 'class=active';
    } elseif ($page == 'archive') {
        $arch = 'class=active';
    } elseif ($page == 'about') {
        $abou = 'class=active';
    }

    echo "
        <nav class='navbar navbar-default'>
            <div class='navbar-header'>
                <a class='navbar-brand' href='#'>Council of One</a>
            </div>
            <ul class='nav navbar-nav'>
                <li ".$home."><a href='index.php'>Home</a></li>
                <li ".$arch."><a href='archive.php'>Archive</a></li>
                <li ".$abou."><a href='about.php'>About</a></li>
            </ul>
        </nav>";
?>
