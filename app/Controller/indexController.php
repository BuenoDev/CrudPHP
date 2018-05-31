<?php

require'./../Model/User.php';

$nome = $_POST['name'];
$email = $_POST['email'];

$user = new User($nome,$email);
$user->save();


