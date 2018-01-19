<?php

require_once './classes/Courses.php';
$c = new Courses();
$list = $c->get_student_subscriptions();
echo $list;