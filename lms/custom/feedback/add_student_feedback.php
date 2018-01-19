<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$item = $_POST['item'];
$f->add_student_feedback(json_decode($item));