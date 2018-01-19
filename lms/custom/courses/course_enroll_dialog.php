<?php

require_once './classes/Courses.php';
$c = new Courses();
$list = $c->get_courses_enrollment_dialog();
echo $list;