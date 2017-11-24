<?php

require_once './classes/Enroll.php';
$e = new Enroll();
$user = $_REQUEST['user'];
$list = $e->enroll_user(json_decode(base64_decode($user)));
echo $list;


