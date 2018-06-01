<?php

require './app/Model/User.php';

static $rowId = 0;
$users = User::loadAll();


foreach($users as $user){
    echo "<tr class=row".$rowId.">";
    echo '<td class= td'.$rowId.'>'.$user->getId().'</td>'.'<td>'.$user->name.'</td>'.'<td>'.$user->email.'</td>';
    echo '</tr>';
    $rowId++;
}