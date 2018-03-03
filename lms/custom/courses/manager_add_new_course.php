<?php

require_once './classes/Courses.php';
$c    = new Courses();
$item = $_REQUEST['item'];
$list = $c->add_new_course(json_decode($item));
echo $list;