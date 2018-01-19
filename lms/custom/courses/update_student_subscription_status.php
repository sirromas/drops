<?php

require_once './classes/Courses.php';
$c = new Courses();
$trans_id = $_POST['trans_id'];
$c->change_student_subscription_status($trans_id);