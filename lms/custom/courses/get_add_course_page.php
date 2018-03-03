<?php

require_once './classes/Courses.php';
$c    = new Courses();
$list = $c->get_add_course_page();
echo $list;

