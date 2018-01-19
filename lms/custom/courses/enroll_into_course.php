<?php

require_once './classes/Courses.php';
$c = new Courses();
$item = $_POST['item'];
$c->enroll_into_course(json_decode($item));