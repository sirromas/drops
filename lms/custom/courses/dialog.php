<?php

require_once './classes/Courses.php';
$c = new Courses();
$id = $_POST['id'];
$list = $c->get_course_edit_dialog($id);
echo $list;