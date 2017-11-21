<?php

require_once './classes/Courses.php';
$c = new Courses();
$file = $_FILES;
$post = $_POST;
$c->update_course_data($file, $post);
