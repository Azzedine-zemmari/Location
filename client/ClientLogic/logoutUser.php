<?php

require "../ClientLogic/user.php";
$user = new user();
$logout = $user->logout();
