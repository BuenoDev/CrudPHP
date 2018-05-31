<?php

require './app/Model/User.php';

$users = User::loadAll();

foreach($users as $user){
    echo '<tr>';
    echo '<td>'.$user->getId().'</td>'.'<td>'.$user->name.'</td>'.'<td>'.$user->email.'</td>';
    echo '</tr>';
}