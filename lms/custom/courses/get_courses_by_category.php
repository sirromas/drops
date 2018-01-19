<?php

require_once './classes/Courses.php';
$c = new Courses();
$id = $_POST['id'];
$list = $c->get_courses_by_category($id);
echo $list;