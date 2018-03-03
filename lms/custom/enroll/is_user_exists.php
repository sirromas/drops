<?php

require_once './classes/Enroll.php';
$en   = new Enroll();
$user = $_REQUEST['user'];
$list = $en->is_user_exists(json_decode($user));
echo $list;