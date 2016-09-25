<?php
    if ($_POST['result'] == 1) {
        $weight = $_POST['fweight'];
    } else if ($_POST['result'] == 2) {
        $weight = $_POST['iweight']*(1/3) + $_POST['fweight']*(2/3);
    } else if ($_POST['result'] == 3) {
        $weight = $_POST['iweight']*(2/3) + $_POST['fweight']*(1/3);
    }

    include('../php/sqlconnect.php');    
    if ($_POST['result'] <= 3) {
        $sql = 'update Vars set Value="'.$weight.'" where Name="weight";';
        $conn->query($sql);
    }
    
    $sql = 'update Vars set Value="'.($_POST['searches']+1).'" where Name="searches";';
    $conn->query($sql);
?>