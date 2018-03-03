<?php

require_once './classes/Users.php';
$u           = new Users();
$item        = new stdClass();
$item->email = 'sirromas@gmail.com';
$item->pwd   = 'memento';
$u->send_confirmation_email($item);
