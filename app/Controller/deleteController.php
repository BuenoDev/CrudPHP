<?php

require __DIR__.'./../Model/User.php';

$id = $_GET['id'];

$user = User::loadFromDb($id);
$user->delete();

